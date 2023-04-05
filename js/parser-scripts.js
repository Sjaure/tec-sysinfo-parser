

const form = document.querySelector('form');
const uploadButton = document.querySelector('#upload-button');
const jsonDataDiv = document.querySelector('#json-data');


function printTable(dataArray, pattern) {
  let table = '<table><thead><tr><th>Key</th><th>Value</th></tr></thead><tbody>';
  dataArray.forEach((item) => {
    if (Array.isArray(item.value)) {
      const innerTable = '<table>' + item.value.map((innerItem) => {
        return '<tr><td>' + innerItem.key + '</td><td>' + innerItem.value + '</td></tr>';
      }).join('') + '</table>';
      table += '<tr><td>' + item.key + '</td><td>' + innerTable + '</td></tr>';
    } else {
      table += '<tr><td>' + item[0] + '</td><td>' + item[1] + '</td></tr>';
    }
  });
  table += '</tbody></table>';
  document.getElementById('json-parser-table').innerHTML = table;
}



function createArray(input) {
  let trimmedInput = input.trim();
  const data = JSON.parse(trimmedInput);
  let dataArray = [];
  for (const [key, value] of Object.entries(data)) {
    if (typeof value === "object") {
      const innerArray = Object.entries(value).map(([k, v]) => {
        return { key: k, value: v };
      });
      dataArray.push({ key, value: innerArray });
    } else {
      dataArray.push([key, value]);
    }
  }
  return dataArray;
}


(function() {
  function handleUpload(event) {
    event.preventDefault();
    const fileInput = document.getElementById('json-file');
    const file = fileInput.files[0];
    if (!file) {
      document.getElementById('error-message').textContent = 'No file selected.';
      return;
    }
    if (file.size > 512 * 1024) {
      document.getElementById('error-message').textContent = 'File size exceeds the maximum allowed (512KB).';
      return;
    }
    const reader = new FileReader();
    reader.onload = function () {
      const content = reader.result;
      try{
        const jsonData = JSON.parse(content);
        const dataArray = createArray(jsonData);
        printTable(dataArray, pattern);
      }catch (err) {
      console.error('Error parsing JSON:', err);
    }
    };
    reader.readAsText(file);
  }
try{
  const uploadButton = document.getElementById('upload-button');
  uploadButton.addEventListener('click', handleUpload);
}catch (err) {
  console.error('Element not found:', err);
}
})();