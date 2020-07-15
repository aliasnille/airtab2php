<?php
// #############################################
//  FUNCTION: LIST
//  - This function is based on "List Records"
//    for Airtables API
// _____________________________________________
function airtab2php_list($apikey, $base, $table, $view, $fields, $where, $sort, $limit) {
  if (!empty($apikey) && !empty($base) && !empty($table)) {
    $param    = "";

    if (!empty($limit) && is_numeric($limit)) {
      $param .= "&maxRecords=".$limit;
    }

    if (!empty($fields)) {
      $fields = explode(";", $fields);
      foreach ($fields as $field) {
        $param .= "&".rawurlencode("fields[]")."=".$field;
      }
    }

    if (!empty($where)) {
      preg_match("/(=|!=)/", $where, $operator);
      $where  = explode($operator[0], $where);
      $param .= "&filterByFormula=".rawurlencode("{".$where[0]."} ".$operator[0]." \"".$where[1]."\"");
    }

    if (!empty($sort)) {
      $sort   = explode(";", $sort);
      $param .= "&".rawurlencode("sort[0][field]")."=".$sort[0]."&".rawurlencode("sort[0][direction]")."=".$sort[1];
    }
  }

  $cURL = curl_init();
  curl_setopt($cURL, CURLOPT_URL, "https://api.airtable.com/v0/".$base."/".$table."?view=".rawurlencode($view).$param);
  $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer '.$apikey
  );
  curl_setopt($cURL, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($cURL, CURLOPT_HTTPGET, true);

  $response = curl_exec($cURL);
  $httpCode = curl_getinfo($cURL, CURLINFO_HTTP_CODE);
  $result = json_decode($response, true);
  curl_close($cURL);

  if ($httpCode == 200 && $result['records']) {
    return $result['records'];
  }
}

// #############################################
//  FUNCTION: CREATE
//  - This function is based on "Create Records"
//    for Airtables API
// _____________________________________________
function airtab2php_create($apikey, $base, $table, $fields, $values) {
  $fields = explode(";", $fields);
  $values = explode(";", $values);
  $data   = array_combine($fields, $values);
  $data   = json_encode(array('fields' => $data), true);

  $cURL = curl_init();
  curl_setopt($cURL, CURLOPT_URL, "https://api.airtable.com/v0/".$base."/".$table);
  $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer '.$apikey
  );
  curl_setopt($cURL, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($cURL, CURLOPT_POST, true);
  curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);

  $response = curl_exec($cURL);
  $httpCode = curl_getinfo($cURL, CURLINFO_HTTP_CODE);
  $result = json_decode($response, true);
  curl_close($cURL);

  if ($httpCode == 200 && !empty($result['id'])) {
    return TRUE;
  }
}

// #############################################
//  FUNCTION: UPDATE
//  - This function is based on "Update Records"
//    for Airtables API
// _____________________________________________
function airtab2php_update($apikey, $base, $table, $id, $fields, $values) {
  $fields = explode(";", $fields);
  $values = explode(";", $values);
  $data   = array_combine($fields, $values);
  $data   = json_encode(array('fields' => $data), true);

  $cURL = curl_init();
  curl_setopt($cURL, CURLOPT_URL, "https://api.airtable.com/v0/".$base."/".$table."/".$id);
  $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer '.$apikey
  );
  curl_setopt($cURL, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($cURL, CURLOPT_CUSTOMREQUEST, 'PATCH');
  curl_setopt($cURL, CURLOPT_POST, true);
  curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);

  $response = curl_exec($cURL);
  $httpCode = curl_getinfo($cURL, CURLINFO_HTTP_CODE);
  $result = json_decode($response, true);
  curl_close($cURL);

  if ($httpCode == 200 && !empty($result['id'])) {
    return TRUE;
  }
}

// #############################################
//  FUNCTION: DELETE
//  - This function is based on "Delete Records"
//    for Airtables API
// _____________________________________________
function airtab2php_delete($apikey, $base, $table, $id) {
  $cURL = curl_init();
  curl_setopt($cURL, CURLOPT_URL, "https://api.airtable.com/v0/".$base."/".$table."/".$id);
  $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer '.$apikey
  );
  curl_setopt($cURL, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($cURL, CURLOPT_CUSTOMREQUEST, 'DELETE');
  curl_setopt($cURL, CURLOPT_POST, true);

  $response = curl_exec($cURL);
  $httpCode = curl_getinfo($cURL, CURLINFO_HTTP_CODE);
  $result = json_decode($response, true);
  curl_close($cURL);

  if ($httpCode == 200 && $result['deleted']) {
    return TRUE;
  }
}
?>
