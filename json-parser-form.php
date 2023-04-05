<!-- HTML form for uploading the JSON file -->
<form enctype="multipart/form-data">
  <label for="json-file">Select a JSON file to upload:</label>
  <input type="file" id="json-file" name="json-file">
  <br>
  <button type="button" id="upload-button">Upload</button>
  <div id="json-data">
  <p id="error-message"></p>
</div>
</form>

<!-- HTML div for displaying the parsed JSON data -->
<div id="json-parser-table"></div>
<style>
#json-parser-table {
  border-collapse: collapse;
  font-size: 1em;
}

#json-parser-table td, #json-parser-table th {
  border: 1px solid black;
  padding: 1px 5px;
}

#json-parser-table th {
  background-color: #ccc;
  text-align: left;
}

#json-parser-table td {
  text-align: left;
  vertical-align: top;
  white-space: wrap;
  min-width: 20vw;
}
</style>

