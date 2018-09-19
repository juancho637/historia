<?php

namespace App\Http\Controllers;

use App\DetailEngagement;
use App\Engagement;
use App\Http\Requests\StoreEngagementRequest;
use App\Product;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class EngagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::serviceAbbreviation(['aesthetic','services','consultation','surgery'])->get();
        $services = Service::all();
        $engagements = Engagement::byBetweenDates(date("Y-m-d"), date("Y-m-d"))->get();

        return view('admin.engagements.index', compact('users', 'services', 'engagements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $consultations = Product::categoryAbbreviation('consultation')->get();

        return view('admin.engagements.create', compact('users', 'consultations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEngagementRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEngagementRequest $request)
    {
        $fields = $request->all();

        if (!empty($request->home_service)) {
            $lastTurnHomeService = Engagement::byBetweenDates($fields['date'], $fields['date'])
                ->get()
                ->max('home_service_shift');

            $fields['home_service'] = true;
            $fields['home_service_shift'] = $lastTurnHomeService + 1;
        }

        if (!empty($request->engagement_to_be_confirmed)) {
            $fields['engagement_to_be_confirmed'] = true;
        }

        $fields['user_id'] = Auth::user()->id;

        if($fields['details']['consultation']['products'][0] == Product::where('name', 'LIKE', 'CONSULTA SIN COSTO')->first()->id){
            $fields['details']['consultation']['description'] .= ' Sin costo: '.$fields['details']['consultation']['without_cost'];
        }

        $engagement = Engagement::create($fields);
        $purchaseFields = [
            'client_id' => $fields['client_id'],
            'user_id' => $fields['user_id'],
            'pet_id' => $fields['pet_id'],
            'subtotal' => 0,
            'taxes' => 0,
            'total_value' => 0,
        ];
        $purchaseOrder = $engagement->purchaseOrder()->create($purchaseFields);
        $purchaseOrderSubtotal = 0;
        $purchaseOrderTaxes = 0;

        foreach ($fields['services'] as $service){
            $serviceFields = $fields['details'][$service];
            $serviceFields['service_id'] = Service::where('abbreviation', $service)->first()->id;

            if($request->home_service === 'on' || $service === 'aesthetic'){
                $serviceFields['start_time'] = null;
                $serviceFields['end_time'] = null;
            }

            if($serviceFields['products']){
                foreach ($serviceFields['products'] as $product){
                    $item = Product::find($product);
                    $purchaseOrderDetailField = [
                        'product_id' => $product,
                        'quantity' => 1,
                        'tax_percentage' => $item['tax_percentage'],
                        'value' => $item['value']
                    ];
                    $purchaseOrderSubtotal += $item['value'];
                    $purchaseOrderTaxes += (($item['value'] * $item['tax_percentage'])/100);
                    $purchaseOrder->details()->create($purchaseOrderDetailField);
                }
            }

            if($service === 'aesthetic'){
                $lastTurnAesthetic = Engagement::byBetweenDates($fields['date'], $fields['date'])
                    ->with('detailEngagements')
                    ->get()
                    ->pluck('detailEngagements')
                    ->collapse()
                    ->max('assigned_shift');
                if($serviceFields['add']){
                    $serviceFields['description'] .= ' Servicios adicionales: ';
                    foreach ($serviceFields['add'] as $additional){
                        if ($additional === end($serviceFields['add'])) {
                            $serviceFields['description'] .= $additional;
                        }else{
                            $serviceFields['description'] .= $additional.', ';
                        }
                    }
                }
                $serviceFields['assigned_shift'] = $lastTurnAesthetic + 1;
            }

            $detailEngagement = $engagement->detailEngagements()->create($serviceFields);
            $detailEngagement->users()->sync($serviceFields['users']);
        }

        $purchaseOrder->update([
            'subtotal' => $purchaseOrderSubtotal,
            'taxes' => $purchaseOrderTaxes,
            'total_value' => $purchaseOrderSubtotal + $purchaseOrderTaxes
        ]);

        return redirect()->route('engagements.index')->with('flash', 'Cita creada correctamente, <a target="_blank" href="'. route("engagements.print", $engagement->id) .'">Imprimela</a>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Engagement  $engagement
     * @return \Illuminate\Http\Response
     */
    public function show(Engagement $engagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Engagement  $engagement
     * @return \Illuminate\Http\Response
     */
    public function edit(Engagement $engagement)
    {
        $users = User::all();
        $consultations = Product::categoryAbbreviation('consultation')->get();

        return view('admin.engagements.edit', compact('users', 'engagement', 'consultations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreEngagementRequest $request
     * @param  \App\Engagement $engagement
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEngagementRequest $request, Engagement $engagement)
    {
        $fields = $request->all();
        $purchaseOrder = $engagement->purchaseOrder;

        foreach ($engagement->detailEngagements as $detailEngagement){
            $detailEngagement->users()->detach();
            $detailEngagement->delete();
        }

        $purchaseOrder->details()->delete();

        if (!empty($request->home_service)) {
            $lastTurnHomeService = Engagement::byBetweenDates($fields['date'], $fields['date'])
                ->where('id', '<>', $engagement->id)
                ->get()
                ->max('home_service_shift');

            $fields['home_service'] = true;
            $fields['home_service_shift'] = $lastTurnHomeService + 1;
        }else{
            $fields['home_service'] = false;
            $fields['home_service_shift'] = null;
        }

        if (!empty($request->engagement_to_be_confirmed)) {
            $fields['engagement_to_be_confirmed'] = true;
        }else{
            $fields['engagement_to_be_confirmed'] = false;
        }

        $engagement->update($fields);

        $purchaseOrderSubtotal = 0;
        $purchaseOrderTaxes = 0;

        foreach ($fields['services'] as $service){
            $serviceFields = $fields['details'][$service];
            $serviceFields['service_id'] = Service::where('abbreviation', $service)->first()->id;

            if($request->home_service === 'on' || $service === 'aesthetic'){
                $serviceFields['start_time'] = null;
                $serviceFields['end_time'] = null;
            }

            if($serviceFields['products']){
                foreach ($serviceFields['products'] as $product){
                    $item = Product::find($product);
                    $purchaseOrderDetailField = [
                        'product_id' => $product,
                        'quantity' => 1,
                        'tax_percentage' => $item['tax_percentage'],
                        'value' => $item['value']
                    ];
                    $purchaseOrderSubtotal += $item['value'];
                    $purchaseOrderTaxes += (($item['value'] * $item['tax_percentage'])/100);
                    $purchaseOrder->details()->create($purchaseOrderDetailField);
                }
            }

            if($service === 'aesthetic'){
                $lastTurnAesthetic = Engagement::byBetweenDates($fields['date'], $fields['date'])
                    ->with('detailEngagements')
                    ->get()
                    ->pluck('detailEngagements')
                    ->collapse()
                    ->max('assigned_shift');
                if(isset($serviceFields['add'])){
                    $serviceFields['description'] .= ' Servicios adicionales: ';
                    foreach ($serviceFields['add'] as $additional){
                        if ($additional === end($serviceFields['add'])) {
                            $serviceFields['description'] .= $additional;
                        }else{
                            $serviceFields['description'] .= $additional.', ';
                        }
                    }
                }else{
                    $serviceFields['description'] .= ' Servicios adicionales: no';
                }
                $serviceFields['assigned_shift'] = $lastTurnAesthetic + 1;
            }

            $detailEngagement = $engagement->detailEngagements()->create($serviceFields);
            $detailEngagement->users()->sync($serviceFields['users']);
        }

        $engagement->purchaseOrder()->update([
            'subtotal' => $purchaseOrderSubtotal,
            'taxes' => $purchaseOrderTaxes,
            'total_value' => $purchaseOrderSubtotal + $purchaseOrderTaxes
        ]);

        return redirect()->route('engagements.index')->with('flash', 'Cita actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Engagement  $engagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engagement $engagement)
    {
        //
    }

    /**
     * @param Engagement $engagement
     * @return mixed
     * @throws \Throwable
     */
    public function print(Engagement $engagement)
    {
        $view = view('admin.engagements.print', compact('engagement'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();
    }
}
