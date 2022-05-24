<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/order.php';
include_once '../user/auth.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate order object
$order = new Order($db);
// Get ID
if (!empty($_GET['user_id'])) {
    $result = $order->read($_GET['user_id'], $_GET['load']);
    // Get row count
    $num = $result->rowCount();
    // Check if any order
    if ($num > 0) {
        $final_as = [];
        // order array
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $order_item = array(
                'Order_ID' => $row['Order_ID'],
                'Status' => $row['Status'],
                'Created_At' => $row['Created_At'],
                'Total' => $row['Total']
            );
            if (!empty($_GET['status'])) {
                if (!empty($_GET['time']) && empty($_GET['name'])) {
                    //status time
                    $arr_time = explode(",", $_GET['time']);
                    $arr_time = explode(",", $_GET['time']);
                    if (in_array("lweek", $arr_time)) {
                        $dataa = "WEEK(Created_At) = WEEK(NOW()) - 1";
                    } else if (in_array("lmonth", $arr_time)) {
                        $dataa = "MONTH(Created_At) = MONTH(NOW()) - 1";
                    } else if (in_array("lyear", $arr_time)) {
                        $dataa = "YEAR(Created_At) = YEAR(NOW()) - 1";
                    }
                    $success = $order->check_st($row['Order_ID'], $_GET['status'], $dataa);
                    if (count($success) > 0) {
                        $final_arr = [];
                        $final_arr['detail'] = [];
                        $final_arr['name'] = [];
                        $final_arr['clr'] = [];
                        $final_arr['size'] = [];
                        $final_arr['qty'] = [];
                        foreach ($success as $val) {
                            $productid = explode(",", $val['Product_ID']);
                            $qty = explode(",", $val['Quantity']);
                            $clr = explode(",", $val['Color']);
                            $size = explode(",", $val['Size']);
                        }

                        array_push($final_arr['detail'], $order_item);


                        foreach ($productid as $pid) {
                            $pdt = $order->get_details_pdt($pid);
                            array_push($final_arr['name'], $pdt);
                        }
                        foreach ($clr as $cid) {
                            $clrnew = $order->get_clr($cid);
                            array_push($final_arr['clr'], $clrnew);
                        }
                        foreach ($size as $sid) {
                            $sizenew = $order->get_size($sid);
                            array_push($final_arr['size'], $sizenew);
                        }
                        foreach ($qty as $q) {
                            array_push($final_arr['qty'], $q);
                        }
                        $final[] = array_merge($final_as, $final_arr);
                    }
                } else if (!empty($_GET['name'])) {
                    // status name
                    $success = $order->check_s($row['Order_ID'], $_GET['status']);

                    if (count($success) > 0) {
                        $final_arr = [];
                        $final_arr['detail'] = [];
                        $final_arr['name'] = [];
                        $final_arr['clr'] = [];
                        $final_arr['size'] = [];
                        $final_arr['qty'] = [];
                        foreach ($success as $val) {
                            $productid = explode(",", $val['Product_ID']);
                            $qty = explode(",", $val['Quantity']);
                            $clr = explode(",", $val['Color']);
                            $size = explode(",", $val['Size']);
                        }
                        for ($i = 0; $i < count($productid); $i++) {
                            $pdt = $order->check_stn($productid[$i], $_GET['name']);
                            if (count($pdt) > 0) {
                                array_push($final_arr['name'], $pdt);
                                $clrnew = $order->get_clr($clr[$i]);
                                array_push($final_arr['clr'], $clrnew);
                                $sizenew = $order->get_size($size[$i]);
                                array_push($final_arr['size'], $sizenew);
                                array_push($final_arr['qty'], $qty[$i]);
                                array_push($final_arr['detail'], $order_item);
                            } else {
                                continue 1;
                            }
                        }
                        $final[] = array_filter(array_merge($final_as, $final_arr));
                    }
                } else if (!empty($_GET['name'])) {
                    //stays time name
                    echo "dd";
                    $arr_time = explode(",", $_GET['time']);
                    if (in_array("lweek", $arr_time)) {
                        $dataa = "WEEK(Created_At) = WEEK(NOW()) - 1";
                    } else if (in_array("lmonth", $arr_time)) {
                        $dataa = "MONTH(Created_At) = MONTH(NOW()) - 1";
                    } else if (in_array("lyear", $arr_time)) {
                        $dataa = "YEAR(Created_At) = YEAR(NOW()) - 1";
                    }
                    $success = $order->check_st($row['Order_ID'], $_GET['status'], $dataa);
                    if (count($success) > 0) {
                        $final_arr = [];
                        $final_arr['detail'] = [];
                        $final_arr['name'] = [];
                        $final_arr['clr'] = [];
                        $final_arr['size'] = [];
                        $final_arr['qty'] = [];
                        foreach ($success as $val) {
                            $productid = explode(",", $val['Product_ID']);
                            $qty = explode(",", $val['Quantity']);
                            $clr = explode(",", $val['Color']);
                            $size = explode(",", $val['Size']);
                        }
                        for ($i = 0; $i < count($productid); $i++) {
                            $pdt = $order->check_stn($productid[$i], $_GET['name']);
                            if (count($pdt) > 0) {
                                array_push($final_arr['name'], $pdt);
                                $clrnew = $order->get_clr($clr[$i]);
                                array_push($final_arr['clr'], $clrnew);
                                $sizenew = $order->get_size($size[$i]);
                                array_push($final_arr['size'], $sizenew);
                                array_push($final_arr['qty'], $qty[$i]);
                                array_push($final_arr['detail'], $order_item);
                            } else {
                                continue 1;
                            }
                        }
                        $final[] = array_filter(array_merge($final_as, $final_arr));
                    }
                } else {
                    //status
                    $success = $order->check_s($row['Order_ID'], $_GET['status']);
                    if (count($success) > 0) {
                        $final_arr = [];
                        $final_arr['detail'] = [];
                        $final_arr['name'] = [];
                        $final_arr['clr'] = [];
                        $final_arr['size'] = [];
                        $final_arr['qty'] = [];
                        foreach ($success as $val) {
                            $productid = explode(",", $val['Product_ID']);
                            $qty = explode(",", $val['Quantity']);
                            $clr = explode(",", $val['Color']);
                            $size = explode(",", $val['Size']);
                        }

                        array_push($final_arr['detail'], $order_item);


                        foreach ($productid as $pid) {
                            $pdt = $order->get_details_pdt($pid);
                            array_push($final_arr['name'], $pdt);
                        }
                        foreach ($clr as $cid) {
                            $clrnew = $order->get_clr($cid);
                            array_push($final_arr['clr'], $clrnew);
                        }
                        foreach ($size as $sid) {
                            $sizenew = $order->get_size($sid);
                            array_push($final_arr['size'], $sizenew);
                        }
                        foreach ($qty as $q) {
                            array_push($final_arr['qty'], $q);
                        }
                        $final[] = array_merge($final_as, $final_arr);
                    }
                }
            } else if (!empty($_GET['time'])) {
                if (!empty($_GET['name'])) {
                    //time name
                    $arr_time = explode(",", $_GET['time']);
                    $arr_time = explode(",", $_GET['time']);
                    if (in_array("lweek", $arr_time)) {
                        $dataa = "WEEK(Created_At) = WEEK(NOW()) - 1";
                    } else if (in_array("lmonth", $arr_time)) {
                        $dataa = "MONTH(Created_At) = MONTH(NOW()) - 1";
                    } else if (in_array("lyear", $arr_time)) {
                        $dataa = "YEAR(Created_At) = YEAR(NOW()) - 1";
                    }
                    $success = $order->check_t($row['Order_ID'], $dataa);
                    if (count($success) > 0) {
                        $final_arr = [];
                        $final_arr['detail'] = [];
                        $final_arr['name'] = [];
                        $final_arr['clr'] = [];
                        $final_arr['size'] = [];
                        $final_arr['qty'] = [];
                        foreach ($success as $val) {
                            $productid = explode(",", $val['Product_ID']);
                            $qty = explode(",", $val['Quantity']);
                            $clr = explode(",", $val['Color']);
                            $size = explode(",", $val['Size']);
                        }
                        for ($i = 0; $i < count($productid); $i++) {
                            $pdt = $order->check_stn($productid[$i], $_GET['name']);
                            if (count($pdt) > 0) {
                                array_push($final_arr['name'], $pdt);
                                $clrnew = $order->get_clr($clr[$i]);
                                array_push($final_arr['clr'], $clrnew);
                                $sizenew = $order->get_size($size[$i]);
                                array_push($final_arr['size'], $sizenew);
                                array_push($final_arr['qty'], $qty[$i]);
                                array_push($final_arr['detail'], $order_item);
                            } else {
                                continue 1;
                            }
                        }
                        $final[] = array_filter(array_merge($final_as, $final_arr));
                    }
                } else {
                    //time
                    $arr_time = explode(",", $_GET['time']);
                    if (in_array("lweek", $arr_time)) {
                        $dataa = "WEEK(Created_At) = WEEK(NOW()) - 1";
                    } else if (in_array("lmonth", $arr_time)) {
                        $dataa = "MONTH(Created_At) = MONTH(NOW()) - 1";
                    } else if (in_array("lyear", $arr_time)) {
                        $dataa = "YEAR(Created_At) = YEAR(NOW()) - 1";
                    }
                    $success = $order->check_t($row['Order_ID'], $dataa);
                    if (count($success) > 0) {
                        $final_arr = [];
                        $final_arr['detail'] = [];
                        $final_arr['name'] = [];
                        $final_arr['clr'] = [];
                        $final_arr['size'] = [];
                        $final_arr['qty'] = [];
                        foreach ($success as $val) {
                            $productid = explode(",", $val['Product_ID']);
                            $qty = explode(",", $val['Quantity']);
                            $clr = explode(",", $val['Color']);
                            $size = explode(",", $val['Size']);
                        }

                        array_push($final_arr['detail'], $order_item);


                        foreach ($productid as $pid) {
                            $pdt = $order->get_details_pdt($pid);
                            array_push($final_arr['name'], $pdt);
                        }
                        foreach ($clr as $cid) {
                            $clrnew = $order->get_clr($cid);
                            array_push($final_arr['clr'], $clrnew);
                        }
                        foreach ($size as $sid) {
                            $sizenew = $order->get_size($sid);
                            array_push($final_arr['size'], $sizenew);
                        }
                        foreach ($qty as $q) {
                            array_push($final_arr['qty'], $q);
                        }
                        $final[] = array_merge($final_as, $final_arr);
                    }
                }
            } else if (!empty($_GET['name'])) {
                //name
                $success = $order->get_orderid($row['Order_ID']);
                if (count($success) > 0) {
                    $final_arr = [];
                    $final_arr['detail'] = [];
                    $final_arr['name'] = [];
                    $final_arr['clr'] = [];
                    $final_arr['size'] = [];
                    $final_arr['qty'] = [];
                    foreach ($success as $val) {
                        $productid = explode(",", $val['Product_ID']);
                        $qty = explode(",", $val['Quantity']);
                        $clr = explode(",", $val['Color']);
                        $size = explode(",", $val['Size']);
                    }
                    for ($i = 0; $i < count($productid); $i++) {
                        $pdt = $order->check_stn($productid[$i], $_GET['name']);
                        if (count($pdt) > 0) {
                            array_push($final_arr['name'], $pdt);
                            $clrnew = $order->get_clr($clr[$i]);
                            array_push($final_arr['clr'], $clrnew);
                            $sizenew = $order->get_size($size[$i]);
                            array_push($final_arr['size'], $sizenew);
                            array_push($final_arr['qty'], $qty[$i]);
                            array_push($final_arr['detail'], $order_item);
                        } else {
                            continue 1;
                        }
                    }
                    $final[] = array_filter(array_merge($final_as, $final_arr));
                }
            } else {
                //default
                $success = $order->get_orderid($row['Order_ID']);
                if (count($success) > 0) {
                    $final_arr = [];
                    $final_arr['detail'] = [];
                    $final_arr['name'] = [];
                    $final_arr['clr'] = [];
                    $final_arr['size'] = [];
                    $final_arr['qty'] = [];
                    foreach ($success as $val) {
                        $productid = explode(",", $val['Product_ID']);
                        $qty = explode(",", $val['Quantity']);
                        $clr = explode(",", $val['Color']);
                        $size = explode(",", $val['Size']);
                    }

                    array_push($final_arr['detail'], $order_item);
                    foreach ($productid as $pid) {
                        $pdt = $order->get_details_pdt($pid);
                        array_push($final_arr['name'], $pdt);
                    }
                    foreach ($clr as $cid) {
                        $clrnew = $order->get_clr($cid);
                        array_push($final_arr['clr'], $clrnew);
                    }
                    foreach ($size as $sid) {
                        $sizenew = $order->get_size($sid);
                        array_push($final_arr['size'], $sizenew);
                    }
                    foreach ($qty as $q) {
                        array_push($final_arr['qty'], $q);
                    }
                    $final[] = array_merge($final_as, $final_arr);
                }
            }
        }
        if (isset($final)) {
            echo json_encode(
                array_filter(array_values(array_filter($final)))
            );
        } else {
            $final = [];
            echo json_encode(
                array_filter(array_values(array_filter($final)))
            );
        }
    } else {
        // No order
        echo json_encode(
            array('message' => 'No order Found')
        );
    }
}
