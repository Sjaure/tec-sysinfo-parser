<?php
/*
Plugin Name: JSON Parser
Plugin URI: 
Description: 
Version: 1.0
Author: 
License: GPL2
*/

if( !class_exists('JsonParser')):

class JsonParser {
  private $jsonData;

  public function __construct() {
    $this->jsonData = null;
    add_shortcode('json_parser_form',  array($this,'json_parser_form_shortcode'));
    // Handle form submissions
    //add_action('init', array($this,'json_parser_handle_form_submission')); 
    add_action('wp_enqueue_scripts', array($this, 'enqueue_parser_scripts'));
  }

  public function enqueue_parser_scripts() {
    // Get the URL of the script
    $script_url = plugins_url('/js/parser-scripts.js', __FILE__);
    // Enqueue js assets in the footer
    wp_enqueue_script('parser-scripts', $script_url, array(), '1.0.0', true);
  }
  /*
  function json_parser_handle_form_submission() {
    if (isset($_POST['json_parser_submit'])) {
      $jsonParser = new JsonParser();
  
      try {
        $jsonParser->uploadFile($_FILES["json_file"]);
        $output = $jsonParser->jsonToHtmlTable();
        echo $output;
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
  }
*/
  function json_parser_form_shortcode() {
    ob_start();
    include 'json-parser-form.php';
    return ob_get_clean();
  }
  
  /*
  public function uploadFile($file) {
    if ($file["error"] == UPLOAD_ERR_OK) {
      $fileTmpPath = $file["tmp_name"];
      $fileName = $file["name"];
      $fileSize = $file["size"];
      $fileType = $file["type"];

      if (in_array($fileType, array("application/json"))) {
        $jsonData = file_get_contents($fileTmpPath);
        $this->jsonData = json_decode($jsonData, true);
        return true;
      } else {
        throw new Exception("Invalid file type.");
      }
    } else {
      throw new Exception("Error uploading file.");
    }
  }
  

  public function searchValues($searchValue) {
    if ($this->jsonData) {
      $matches = array();

      foreach ($this->jsonData as $key => $value) {
        if (is_array($value)) {
          $subMatches = $this->searchValuesInArray($value, $searchValue, $key);
          $matches = array_merge($matches, $subMatches);
        } elseif (is_string($value) && strpos($value, $searchValue) !== false) {
          $matches[] = array("key" => $key, "value" => $value);
        }
      }

      return $matches;
    } else {
      throw new Exception("No JSON data to search.");
    }
  }
  
  private function searchValuesInArray($array, $searchValue, $prefix = "") {
    $matches = array();

    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $subMatches = $this->searchValuesInArray($value, $searchValue, $prefix . "." . $key);
        $matches = array_merge($matches, $subMatches);
      } elseif (is_string($value) && strpos($value, $searchValue) !== false) {
        $matches[] = array("key" => $prefix . "." . $key, "value" => $value);
      }
    }

    return $matches;
  }
  
  function jsonToHtmlTable() {
    $data = $this->jsonData;
    
    if ($data === null) {
      throw new Exception('Invalid JSON format');
    }
    
    $table = '<table>';
    
    // Add header row
    $headerRow = '<tr>';
    foreach (array_keys($data[0]) as $key) {
      $headerRow .= '<th>' . $key . '</th>';
    }
    $headerRow .= '</tr>';
    $table .= $headerRow;
    
    // Add data rows
    foreach ($data as $row) {
      $dataRow = '<tr>';
      foreach ($row as $value) {
        $dataRow .= '<td>' . $value . '</td>';
      }
      $dataRow .= '</tr>';
      $table .= $dataRow;
    }
    
    $table .= '</table>';
    
    return $table;
  }
    */
}
new JsonParser;

endif;