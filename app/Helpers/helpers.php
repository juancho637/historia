<?php
    if (!function_exists('color_stock_helper')) {
        function color_stock_helper($due_date){
            if($due_date <= date("Y-m-d", strtotime("+3 months"))){
                return "style=background:#ef9a9a";
            }else if($due_date <= date("Y-m-d", strtotime("+6 months"))){
                return "style=background:#ffcc80";
            }else if($due_date <= date("Y-m-d", strtotime("+1 years"))){
                return "style=background:#fff59d";
            }else{
                return "";
            }
        }
    }

    if (!function_exists('services_check_helper')) {
        function services_check_helper($services, $service_name){
            foreach ($services as $service){
                if(is_object($service)){
                    if($service->service->abbreviation === $service_name){
                        return true;
                    }
                }else{
                    if($service === $service_name){
                        return true;
                    }
                }
            }
        }
    }

    if (!function_exists('users_services_helper')) {
        function users_services_helper($services, $service_name){
            foreach ($services as $service){
                if(is_object($service)){
                    if($service->service->abbreviation === $service_name){
                        return $service->users->pluck('id')->toArray();
                    }
                }
            }
        }
    }

    if (!function_exists('start_time_services_helper')) {
        function start_time_services_helper($services, $service_name){
            foreach ($services as $service){
                if(is_object($service)){
                    if($service->service->abbreviation === $service_name){
                        return $service->start_time;
                    }
                }
            }
        }
    }

    if (!function_exists('end_time_services_helper')) {
        function end_time_services_helper($services, $service_name){
            foreach ($services as $service){
                if(is_object($service)){
                    if($service->service->abbreviation === $service_name){
                        return $service->end_time;
                    }
                }
            }
        }
    }

    if (!function_exists('description_services_helper')) {
        function description_services_helper($services, $service_name, $serviceAdd = null){
            foreach ($services as $service){
                if(is_object($service)){
                    if($service->service->abbreviation === $service_name){
                        if($service_name === 'aesthetic'){
                            $parts = explode(" Servicios adicionales: ",$service->description);
                            if ($serviceAdd === null){
                                return $parts[0];
                            }else{
                                $servicesAdd = explode(", ", $parts[1]);
                                if(in_array($serviceAdd, $servicesAdd)){
                                    return true;
                                }
                            }
                        }else{
                            return $service->description;
                        }
                    }
                }
            }
        }
    }

    if (!function_exists('convert_date_helper')) {
        function convert_date_helper($original_date){
            $date = strftime("%A, %d de %B del %Y", strtotime($original_date));

            $date = str_replace("Monday","Lunes", $date);
            $date = str_replace("Tuesday","Martes", $date);
            $date = str_replace("Wednesday","Miércoles", $date);
            $date = str_replace("Thursday","Jueves", $date);
            $date = str_replace("Friday","Viernes", $date);
            $date = str_replace("Saturday","Sabado", $date);
            $date = str_replace("Sunday","Domingo", $date);

            $date = str_replace("January","Enero", $date);
            $date = str_replace("February","Febrero", $date);
            $date = str_replace("March","Marzo", $date);
            $date = str_replace("April","Abril", $date);
            $date = str_replace("May","Mayo", $date);
            $date = str_replace("June","Junio", $date);
            $date = str_replace("July","Julio", $date);
            $date = str_replace("August","Agosto", $date);
            $date = str_replace("September","Setiembre", $date);
            $date = str_replace("October","Octubre", $date);
            $date = str_replace("November","Noviembre", $date);
            $date = str_replace("December","Diciembre", $date);

            return $date;
        }
    }

