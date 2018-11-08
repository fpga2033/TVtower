<html>
  <head>
      <h3> 1222 </h3>
  </head>

  <body>
    <!--
    BEFORE RUNNING:
    ---------------
    1. If not already done, enable the Google Sheets API
       and check the quota for your project at
       https://console.developers.google.com/apis/api/sheets
    2. Get access keys for your application. See
       https://developers.google.com/api-client-library/javascript/start/start-js#get-access-keys-for-your-application
    3. For additional information on authentication, see
       https://developers.google.com/sheets/api/quickstart/js#step_2_set_up_the_sample
    -->
    <script>
    function makeApiCall() {
      var params = {

        spreadsheetId: '1oMxmdfvyTdLbt6qE4A6oefZbTkfsgwQmK-noAHtsqUw',  
        range: 'Sheet1',  

        // How values should be represented in the output.
        // The default render option is ValueRenderOption.FORMATTED_VALUE.
        ///valueRenderOption: '',  // TODO: Update placeholder value.

        // How dates, times, and durations should be represented in the output.
        // This is ignored if value_render_option is: FORMATTED_VALUE.
        // The default dateTime render option is [DateTimeRenderOption.SERIAL_NUMBER].
        //dateTimeRenderOption: '',  // TODO: Update placeholder value.
      };

      var request = gapi.client.sheets.spreadsheets.values.get(params);
      request.then(function(response) {
        
        // TODO: Change code below to process the `response` object:
        log(response.result);
        console.log(response.result);
        populateSheet(response.result);
        //alert("response.result");
        //document.writeln("<p> このページは、「" + document.title + "」だよ！</p>");


      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });
    }

    function initClient() {
      var API_KEY = 'AIzaSyARYxwdJGZifzTMzVbugm2y3e_usJyeSI0';  

      var CLIENT_ID = '245476283463-52jkpneqbe8dkd9dk3p4juptd8c3s1ph.apps.googleusercontent.com'; 
      var SCOPE = 'https://www.googleapis.com/auth/spreadsheets.readonly';

      gapi.client.init({
        'apiKey': API_KEY,
        'clientId': CLIENT_ID,
        'scope': SCOPE,
        'discoveryDocs': ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
      }).then(function() {
        //gapi.auth2.getAuthInstance().isSignedIn.listen(updateSignInStatus);
        //updateSignInStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
      });
    }

    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }

    function updateSignInStatus(isSignedIn) {
      if (isSignedIn) {
        makeApiCall();
      }
    }
    //makeApiCall();

    function handleSignInClick(event) {
      gapi.auth2.getAuthInstance().signIn();
    }

    function handleSignOutClick(event) {
      gapi.auth2.getAuthInstance().signOut();
    }

    //
    function populateSheet(result){
        for( var row=0; row<10; row++ ){
            for( var col=0; col<3; col++ ){
                document.getElementById(row+":"+col).value = result.values[row][col];
            }

        }

    }



    </script>

    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    
    <button id="signin-button" onclick="handleSignInClick()">Sign in</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign out</button>

    <?php

      for($row=0; $row<10; $row++ ){
        echo "<div style='clear:both'>";
        for($col=0; $col<3; $col++ ){
          echo "<input type='text' style='float:left;' name='$row:$col' id='$row:$col'>";

        }
        echo "</div>";
      }

    ?>



  </body>
</html>