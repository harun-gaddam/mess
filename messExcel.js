$(document).ready(function () {
      // Replace 'YOUR_GOOGLE_SHEET_LINK' with the published link from Google Sheets
      const googleSheetLink = "https://docs.google.com/spreadsheets/d/1tKerEIwmN2q8TfoGLOAQMc57tisYcznQbb9RR4qEvBw/edit?usp=sharing";

      $.ajax(googleSheetLink)
        .then(response => {
          const data = response.split(/[\r\n]+/);

          // Assuming the first row contains headers
          const headers = data[0].split(',');

          // Remove the first element as it's an empty string
          headers.shift();

          // Remove the last element as it's also an empty string
          data.pop();

          const menuTable = $('#menuTable tbody');

          // Populate the table with data
          data.forEach(row => {
            const rowData = row.split(',');

            menuTable.append(`
              <tr>
                <td>${rowData[0]}</td>
                <td>${rowData[1]}</td>
                <td>${rowData[2]}</td>
                <td>${rowData[3]}</td>
              </tr>
            `);
          });
        });
    });