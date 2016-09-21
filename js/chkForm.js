
//admin_enter_play1.php
function onlyBL_Click(){

  if (document.play.onlyBL.checked){
    document.play.free.checked=0;
  }
  return true;
}

//admin_enter_play1.php
function free_Click(){

  if (document.play.free.checked){
    document.play.onlyBL.checked=0;
  }
  return true;
}

//admin_enter_play1.php
function chk_admin_play1() {

  var Teams = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

  with (document.play) {

//<1. Spiel

    // date1
    if(date1.value == "")  {
      alert("Fehlende Eingabe für das Datum des 1. Spiels!");
      date1.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date1.value.charAt(0) < "0" || date1.value.charAt(0) > "9") chkZ = -1;
    if (date1.value.charAt(1) < "0" || date1.value.charAt(1) > "9") chkZ = -1;
    if (date1.value.charAt(2) != ".") chkZ = -1;
    if (date1.value.charAt(3) < "0" || date1.value.charAt(3) > "9") chkZ = -1;
    if (date1.value.charAt(4) < "0" || date1.value.charAt(4) > "9") chkZ = -1;
    if (date1.value.charAt(5) != ".") chkZ = -1;
    if (date1.value.charAt(6) < "0" || date1.value.charAt(6) > "9") chkZ = -1;
    if (date1.value.charAt(7) < "0" || date1.value.charAt(7) > "9") chkZ = -1;
    if (date1.value.charAt(8) < "0" || date1.value.charAt(8) > "9") chkZ = -1;
    if (date1.value.charAt(9) < "0" || date1.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 1. Spiels!");
      date1.focus();
      return false;
    }

    // hour1
    if(hour1.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 1. Spiels!");
      hour1.focus();
      return false;
    } // if

    if (hour1.value.charAt(0) < "0" || hour1.value.charAt(0) > "9") chkZ = -1;
    if ( (hour1.value.charAt(1) < "0" || hour1.value.charAt(1) > "9") && hour1.value.charAt(1) != "") chkZ = -1;
    if (hour1.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 1. Spiels!");
      hour1.focus();
      return false;
    }

    // min1
    if(min1.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 1. Spiels!");
      min1.focus();
      return false;
    } // if

    if (min1.value.charAt(0) < "0" || min1.value.charAt(0) > "9") chkZ = -1;
    if ( (min1.value.charAt(1) < "0" || min1.value.charAt(1) > "9") && min1.value.charAt(1) != "") chkZ = -1;
    if (min1.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 1. Spiels!");
      min1.focus();
      return false;
    }

    // team1
    if (team1.value == 0) {
      alert("Bitte Heimteam für 1. Spiel wählen!");
      team1.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team1.value] != 0) {
      alert("Heimteam des 1. Spiels kommt bereits in anderer Paarung vor!");
      team1.focus();
      return false;
    }
    else { Teams[team1.value] = team1.value; }

    // team13
    if (team13.value == 0) {
      alert("Bitte Gastteam für 1. Spiel wählen!");
      team13.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team13.value] != 0) {
      alert("Gastteam des 2. Spiels kommt bereits in anderer Paarung vor!");
      team13.focus();
      return false;
    }
    else { Teams[team13.value] = team13.value; }

//1.Spiel>


//<2. Spiel

    // date2
    if(date2.value == "")  {
      alert("Fehlende Eingabe für das Datum des 2. Spiels!");
      date2.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date2.value.charAt(0) < "0" || date2.value.charAt(0) > "9") chkZ = -1;
    if (date2.value.charAt(1) < "0" || date2.value.charAt(1) > "9") chkZ = -1;
    if (date2.value.charAt(2) != ".") chkZ = -1;
    if (date2.value.charAt(3) < "0" || date2.value.charAt(3) > "9") chkZ = -1;
    if (date2.value.charAt(4) < "0" || date2.value.charAt(4) > "9") chkZ = -1;
    if (date2.value.charAt(5) != ".") chkZ = -1;
    if (date2.value.charAt(6) < "0" || date2.value.charAt(6) > "9") chkZ = -1;
    if (date2.value.charAt(7) < "0" || date2.value.charAt(7) > "9") chkZ = -1;
    if (date2.value.charAt(8) < "0" || date2.value.charAt(8) > "9") chkZ = -1;
    if (date2.value.charAt(9) < "0" || date2.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 2. Spiels!");
      date2.focus();
      return false;
    }

    // hour2
    if(hour2.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 2. Spiels!");
      hour2.focus();
      return false;
    } // if

    if (hour2.value.charAt(0) < "0" || hour2.value.charAt(0) > "9") chkZ = -1;
    if ( (hour2.value.charAt(1) < "0" || hour2.value.charAt(1) > "9") && hour2.value.charAt(1) != "") chkZ = -1;
    if (hour2.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 2. Spiels!");
      hour2.focus();
      return false;
    }

    // min2
    if(min2.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 2. Spiels!");
      min2.focus();
      return false;
    } // if

    if (min2.value.charAt(0) < "0" || min2.value.charAt(0) > "9") chkZ = -1;
    if ( (min2.value.charAt(1) < "0" || min2.value.charAt(1) > "9") && min2.value.charAt(1) != "") chkZ = -1;
    if (min2.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 2. Spiels!");
      min2.focus();
      return false;
    }

    // team2
    if (team2.value == 0) {
      alert("Bitte Heimteam für 2. Spiel wählen!");
      team2.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team2.value] != 0) {
      alert("Heimteam des 2. Spiels kommt bereits in anderer Paarung vor!");
      team2.focus();
      return false;
    }
    else { Teams[team2.value] = team2.value; }

    // team14
    if (team14.value == 0) {
      alert("Bitte Gastteam für 2. Spiel wählen!");
      team14.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team14.value] != 0) {
      alert("Gastteam des 2. Spiels kommt bereits in anderer Paarung vor!");
      team14.focus();
      return false;
    }
    else { Teams[team14.value] = team14.value; }


//2.Spiel>

//<3. Spiel

    // date3
    if(date3.value == "")  {
      alert("Fehlende Eingabe für das Datum des 3. Spiels!");
      date3.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date3.value.charAt(0) < "0" || date3.value.charAt(0) > "9") chkZ = -1;
    if (date3.value.charAt(1) < "0" || date3.value.charAt(1) > "9") chkZ = -1;
    if (date3.value.charAt(2) != ".") chkZ = -1;
    if (date3.value.charAt(3) < "0" || date3.value.charAt(3) > "9") chkZ = -1;
    if (date3.value.charAt(4) < "0" || date3.value.charAt(4) > "9") chkZ = -1;
    if (date3.value.charAt(5) != ".") chkZ = -1;
    if (date3.value.charAt(6) < "0" || date3.value.charAt(6) > "9") chkZ = -1;
    if (date3.value.charAt(7) < "0" || date3.value.charAt(7) > "9") chkZ = -1;
    if (date3.value.charAt(8) < "0" || date3.value.charAt(8) > "9") chkZ = -1;
    if (date3.value.charAt(9) < "0" || date3.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 3. Spiels!");
      date3.focus();
      return false;
    }

    // hour3
    if(hour3.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 3. Spiels!");
      hour3.focus();
      return false;
    } // if

    if (hour3.value.charAt(0) < "0" || hour3.value.charAt(0) > "9") chkZ = -1;
    if ( (hour3.value.charAt(1) < "0" || hour3.value.charAt(1) > "9") && hour3.value.charAt(1) != "") chkZ = -1;
    if (hour3.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 3. Spiels!");
      hour3.focus();
      return false;
    }

    // min3
    if(min3.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 3. Spiels!");
      min3.focus();
      return false;
    } // if

    if (min3.value.charAt(0) < "0" || min3.value.charAt(0) > "9") chkZ = -1;
    if ( (min3.value.charAt(1) < "0" || min3.value.charAt(1) > "9") && min3.value.charAt(1) != "") chkZ = -1;
    if (min3.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 3. Spiels!");
      min3.focus();
      return false;
    }

    // team3
    if (team3.value == 0) {
      alert("Bitte Heimteam für 3. Spiel wählen!");
      team3.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team3.value] != 0) {
      alert("Heimteam des 3. Spiels kommt bereits in anderer Paarung vor!");
      team3.focus();
      return false;
    }
    else { Teams[team3.value] = team3.value; }

    // team15
    if (team15.value == 0) {
      alert("Bitte Gastteam für 3. Spiel wählen!");
      team15.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team15.value] != 0) {
      alert("Gastteam des 3. Spiels kommt bereits in anderer Paarung vor!");
      team15.focus();
      return false;
    }
    else { Teams[team15.value] = team15.value; }

//3.Spiel>


//<4. Spiel

    // date4
    if(date4.value == "")  {
      alert("Fehlende Eingabe für das Datum des 4. Spiels!");
      date4.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date4.value.charAt(0) < "0" || date4.value.charAt(0) > "9") chkZ = -1;
    if (date4.value.charAt(1) < "0" || date4.value.charAt(1) > "9") chkZ = -1;
    if (date4.value.charAt(2) != ".") chkZ = -1;
    if (date4.value.charAt(3) < "0" || date4.value.charAt(3) > "9") chkZ = -1;
    if (date4.value.charAt(4) < "0" || date4.value.charAt(4) > "9") chkZ = -1;
    if (date4.value.charAt(5) != ".") chkZ = -1;
    if (date4.value.charAt(6) < "0" || date4.value.charAt(6) > "9") chkZ = -1;
    if (date4.value.charAt(7) < "0" || date4.value.charAt(7) > "9") chkZ = -1;
    if (date4.value.charAt(8) < "0" || date4.value.charAt(8) > "9") chkZ = -1;
    if (date4.value.charAt(9) < "0" || date4.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 4. Spiels!");
      date4.focus();
      return false;
    }

    // hour4
    if(hour4.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 4. Spiels!");
      hour4.focus();
      return false;
    } // if

    if (hour4.value.charAt(0) < "0" || hour4.value.charAt(0) > "9") chkZ = -1;
    if ( (hour4.value.charAt(1) < "0" || hour4.value.charAt(1) > "9") && hour4.value.charAt(1) != "") chkZ = -1;
    if (hour4.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 4. Spiels!");
      hour4.focus();
      return false;
    }

    // min4
    if(min4.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 4. Spiels!");
      min4.focus();
      return false;
    } // if

    if (min4.value.charAt(0) < "0" || min4.value.charAt(0) > "9") chkZ = -1;
    if ( (min4.value.charAt(1) < "0" || min4.value.charAt(1) > "9") && min4.value.charAt(1) != "") chkZ = -1;
    if (min4.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 4. Spiels!");
      min4.focus();
      return false;
    }

    // team4
    if (team4.value == 0) {
      alert("Bitte Heimteam für 4. Spiel wählen!");
      team4.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team4.value] != 0) {
      alert("Heimteam des 4. Spiels kommt bereits in anderer Paarung vor!");
      team4.focus();
      return false;
    }
    else { Teams[team4.value] = team4.value; }

    // team16
    if (team16.value == 0) {
      alert("Bitte Gastteam für 4. Spiel wählen!");
      team16.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team16.value] != 0) {
      alert("Gastteam des 4. Spiels kommt bereits in anderer Paarung vor!");
      team16.focus();
      return false;
    }
    else { Teams[team16.value] = team16.value; }


//4.Spiel>

//<5. Spiel

    // date5
    if(date5.value == "")  {
      alert("Fehlende Eingabe für das Datum des 5. Spiels!");
      date5.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date5.value.charAt(0) < "0" || date5.value.charAt(0) > "9") chkZ = -1;
    if (date5.value.charAt(1) < "0" || date5.value.charAt(1) > "9") chkZ = -1;
    if (date5.value.charAt(2) != ".") chkZ = -1;
    if (date5.value.charAt(3) < "0" || date5.value.charAt(3) > "9") chkZ = -1;
    if (date5.value.charAt(4) < "0" || date5.value.charAt(4) > "9") chkZ = -1;
    if (date5.value.charAt(5) != ".") chkZ = -1;
    if (date5.value.charAt(6) < "0" || date5.value.charAt(6) > "9") chkZ = -1;
    if (date5.value.charAt(7) < "0" || date5.value.charAt(7) > "9") chkZ = -1;
    if (date5.value.charAt(8) < "0" || date5.value.charAt(8) > "9") chkZ = -1;
    if (date5.value.charAt(9) < "0" || date5.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 5. Spiels!");
      date5.focus();
      return false;
    }

    // hour5
    if(hour5.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 5. Spiels!");
      hour5.focus();
      return false;
    } // if

    if (hour5.value.charAt(0) < "0" || hour5.value.charAt(0) > "9") chkZ = -1;
    if ( (hour5.value.charAt(1) < "0" || hour5.value.charAt(1) > "9") && hour5.value.charAt(1) != "") chkZ = -1;
    if (hour5.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 5. Spiels!");
      hour5.focus();
      return false;
    }

    // min5
    if(min5.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 5. Spiels!");
      min5.focus();
      return false;
    } // if

    if (min5.value.charAt(0) < "0" || min5.value.charAt(0) > "9") chkZ = -1;
    if ( (min5.value.charAt(1) < "0" || min5.value.charAt(1) > "9") && min5.value.charAt(1) != "") chkZ = -1;
    if (min5.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 5. Spiels!");
      min5.focus();
      return false;
    }

    // team5
    if (team5.value == 0) {
      alert("Bitte Heimteam für 5. Spiel wählen!");
      team5.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team5.value] != 0) {
      alert("Heimteam des 5. Spiels kommt bereits in anderer Paarung vor!");
      team5.focus();
      return false;
    }
    else { Teams[team5.value] = team5.value; }

    // team17
    if (team17.value == 0) {
      alert("Bitte Gastteam für 5. Spiel wählen!");
      team17.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team17.value] != 0) {
      alert("Gastteam des 5. Spiels kommt bereits in anderer Paarung vor!");
      team17.focus();
      return false;
    }
    else { Teams[team17.value] = team17.value; }


//5.Spiel>

//<6. Spiel

    // date6
    if(date6.value == "")  {
      alert("Fehlende Eingabe für das Datum des 6. Spiels!");
      date6.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date6.value.charAt(0) < "0" || date6.value.charAt(0) > "9") chkZ = -1;
    if (date6.value.charAt(1) < "0" || date6.value.charAt(1) > "9") chkZ = -1;
    if (date6.value.charAt(2) != ".") chkZ = -1;
    if (date6.value.charAt(3) < "0" || date6.value.charAt(3) > "9") chkZ = -1;
    if (date6.value.charAt(4) < "0" || date6.value.charAt(4) > "9") chkZ = -1;
    if (date6.value.charAt(5) != ".") chkZ = -1;
    if (date6.value.charAt(6) < "0" || date6.value.charAt(6) > "9") chkZ = -1;
    if (date6.value.charAt(7) < "0" || date6.value.charAt(7) > "9") chkZ = -1;
    if (date6.value.charAt(8) < "0" || date6.value.charAt(8) > "9") chkZ = -1;
    if (date6.value.charAt(9) < "0" || date6.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 6. Spiels!");
      date6.focus();
      return false;
    }

    // hour6
    if(hour6.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 6. Spiels!");
      hour6.focus();
      return false;
    } // if

    if (hour6.value.charAt(0) < "0" || hour6.value.charAt(0) > "9") chkZ = -1;
    if ( (hour6.value.charAt(1) < "0" || hour6.value.charAt(1) > "9") && hour6.value.charAt(1) != "") chkZ = -1;
    if (hour6.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 6. Spiels!");
      hour6.focus();
      return false;
    }

    // min6
    if(min6.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 6. Spiels!");
      min6.focus();
      return false;
    } // if

    if (min6.value.charAt(0) < "0" || min6.value.charAt(0) > "9") chkZ = -1;
    if ( (min6.value.charAt(1) < "0" || min6.value.charAt(1) > "9") && min6.value.charAt(1) != "") chkZ = -1;
    if (min6.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 6. Spiels!");
      min6.focus();
      return false;
    }

    // team6
    if (team6.value == 0) {
      alert("Bitte Heimteam für 6. Spiel wählen!");
      team6.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team6.value] != 0) {
      alert("Heimteam des 6. Spiels kommt bereits in anderer Paarung vor!");
      team6.focus();
      return false;
    }
    else { Teams[team6.value] = team6.value; }

    // team18
    if (team18.value == 0) {
      alert("Bitte Gastteam für 6. Spiel wählen!");
      team18.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team18.value] != 0) {
      alert("Gastteam des 6. Spiels kommt bereits in anderer Paarung vor!");
      team18.focus();
      return false;
    }
    else { Teams[team18.value] = team18.value; }


//6.Spiel>

//<7. Spiel

    // date7
    if(date7.value == "")  {
      alert("Fehlende Eingabe für das Datum des 7. Spiels!");
      date7.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date7.value.charAt(0) < "0" || date7.value.charAt(0) > "9") chkZ = -1;
    if (date7.value.charAt(1) < "0" || date7.value.charAt(1) > "9") chkZ = -1;
    if (date7.value.charAt(2) != ".") chkZ = -1;
    if (date7.value.charAt(3) < "0" || date7.value.charAt(3) > "9") chkZ = -1;
    if (date7.value.charAt(4) < "0" || date7.value.charAt(4) > "9") chkZ = -1;
    if (date7.value.charAt(5) != ".") chkZ = -1;
    if (date7.value.charAt(6) < "0" || date7.value.charAt(6) > "9") chkZ = -1;
    if (date7.value.charAt(7) < "0" || date7.value.charAt(7) > "9") chkZ = -1;
    if (date7.value.charAt(8) < "0" || date7.value.charAt(8) > "9") chkZ = -1;
    if (date7.value.charAt(9) < "0" || date7.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 7. Spiels!");
      date7.focus();
      return false;
    }

    // hour7
    if(hour7.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 7. Spiels!");
      hour7.focus();
      return false;
    } // if

    if (hour7.value.charAt(0) < "0" || hour7.value.charAt(0) > "9") chkZ = -1;
    if ( (hour7.value.charAt(1) < "0" || hour7.value.charAt(1) > "9") && hour7.value.charAt(1) != "") chkZ = -1;
    if (hour7.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 7. Spiels!");
      hour7.focus();
      return false;
    }

    // min7
    if(min7.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 7. Spiels!");
      min7.focus();
      return false;
    } // if

    if (min7.value.charAt(0) < "0" || min7.value.charAt(0) > "9") chkZ = -1;
    if ( (min7.value.charAt(1) < "0" || min7.value.charAt(1) > "9") && min7.value.charAt(1) != "") chkZ = -1;
    if (min7.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 7. Spiels!");
      min7.focus();
      return false;
    }

    // team7
    if (team7.value == 0) {
      alert("Bitte Heimteam für 7. Spiel wählen!");
      team7.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team7.value] != 0) {
      alert("Heimteam des 7. Spiels kommt bereits in anderer Paarung vor!");
      team7.focus();
      return false;
    }
    else { Teams[team7.value] = team7.value; }

    // team19
    if (team19.value == 0) {
      alert("Bitte Gastteam für 7. Spiel wählen!");
      team19.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team19.value] != 0) {
      alert("Gastteam des 7. Spiels kommt bereits in anderer Paarung vor!");
      team19.focus();
      return false;
    }
    else { Teams[team19.value] = team19.value; }

//7.Spiel>

//<8. Spiel

    // date8
    if(date8.value == "")  {
      alert("Fehlende Eingabe für das Datum des 8. Spiels!");
      date8.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date8.value.charAt(0) < "0" || date8.value.charAt(0) > "9") chkZ = -1;
    if (date8.value.charAt(1) < "0" || date8.value.charAt(1) > "9") chkZ = -1;
    if (date8.value.charAt(2) != ".") chkZ = -1;
    if (date8.value.charAt(3) < "0" || date8.value.charAt(3) > "9") chkZ = -1;
    if (date8.value.charAt(4) < "0" || date8.value.charAt(4) > "9") chkZ = -1;
    if (date8.value.charAt(5) != ".") chkZ = -1;
    if (date8.value.charAt(6) < "0" || date8.value.charAt(6) > "9") chkZ = -1;
    if (date8.value.charAt(7) < "0" || date8.value.charAt(7) > "9") chkZ = -1;
    if (date8.value.charAt(8) < "0" || date8.value.charAt(8) > "9") chkZ = -1;
    if (date8.value.charAt(9) < "0" || date8.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 8. Spiels!");
      date8.focus();
      return false;
    }

    // hour8
    if(hour8.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 8. Spiels!");
      hour8.focus();
      return false;
    } // if

    if (hour8.value.charAt(0) < "0" || hour8.value.charAt(0) > "9") chkZ = -1;
    if ( (hour8.value.charAt(1) < "0" || hour8.value.charAt(1) > "9") && hour8.value.charAt(1) != "") chkZ = -1;
    if (hour8.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 8. Spiels!");
      hour8.focus();
      return false;
    }

    // min8
    if(min8.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 8. Spiels!");
      min8.focus();
      return false;
    } // if

    if (min8.value.charAt(0) < "0" || min8.value.charAt(0) > "9") chkZ = -1;
    if ( (min8.value.charAt(1) < "0" || min8.value.charAt(1) > "9") && min8.value.charAt(1) != "") chkZ = -1;
    if (min8.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 8. Spiels!");
      min8.focus();
      return false;
    }

    // team8
    if (team8.value == 0) {
      alert("Bitte Heimteam für 8. Spiel wählen!");
      team8.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team8.value] != 0) {
      alert("Heimteam des 8. Spiels kommt bereits in anderer Paarung vor!");
      team8.focus();
      return false;
    }
    else { Teams[team8.value] = team8.value; }

    // team20
    if (team20.value == 0) {
      alert("Bitte Gastteam für 8. Spiel wählen!");
      team20.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team20.value] != 0) {
      alert("Gastteam des 8. Spiels kommt bereits in anderer Paarung vor!");
      team20.focus();
      return false;
    }
    else { Teams[team20.value] = team20.value; }

//8.Spiel>

//<9. Spiel

    // date9
    if(date9.value == "")  {
      alert("Fehlende Eingabe für das Datum des 9. Spiels!");
      date9.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date9.value.charAt(0) < "0" || date9.value.charAt(0) > "9") chkZ = -1;
    if (date9.value.charAt(1) < "0" || date9.value.charAt(1) > "9") chkZ = -1;
    if (date9.value.charAt(2) != ".") chkZ = -1;
    if (date9.value.charAt(3) < "0" || date9.value.charAt(3) > "9") chkZ = -1;
    if (date9.value.charAt(4) < "0" || date9.value.charAt(4) > "9") chkZ = -1;
    if (date9.value.charAt(5) != ".") chkZ = -1;
    if (date9.value.charAt(6) < "0" || date9.value.charAt(6) > "9") chkZ = -1;
    if (date9.value.charAt(7) < "0" || date9.value.charAt(7) > "9") chkZ = -1;
    if (date9.value.charAt(8) < "0" || date9.value.charAt(8) > "9") chkZ = -1;
    if (date9.value.charAt(9) < "0" || date9.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 9. Spiels!");
      date9.focus();
      return false;
    }

    // hour9
    if(hour9.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 9. Spiels!");
      hour9.focus();
      return false;
    } // if

    if (hour9.value.charAt(0) < "0" || hour9.value.charAt(0) > "9") chkZ = -1;
    if ( (hour9.value.charAt(1) < "0" || hour9.value.charAt(1) > "9") && hour9.value.charAt(1) != "") chkZ = -1;
    if (hour9.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 9. Spiels!");
      hour9.focus();
      return false;
    }

    // min9
    if(min9.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 9. Spiels!");
      min9.focus();
      return false;
    } // if

    if (min9.value.charAt(0) < "0" || min9.value.charAt(0) > "9") chkZ = -1;
    if ( (min9.value.charAt(1) < "0" || min9.value.charAt(1) > "9") && min9.value.charAt(1) != "") chkZ = -1;
    if (min9.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 9. Spiels!");
      min9.focus();
      return false;
    }

    // team9
    if (team9.value == 0) {
      alert("Bitte Heimteam für 9. Spiel wählen!");
      team9.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team9.value] != 0) {
      alert("Heimteam des 9. Spiels kommt bereits in anderer Paarung vor!");
      team9.focus();
      return false;
    }
    else { Teams[team9.value] = team9.value; }

    // team21
    if (team21.value == 0) {
      alert("Bitte Gastteam für 9. Spiel wählen!");
      team21.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team21.value] != 0) {
      alert("Gastteam des 9. Spiels kommt bereits in anderer Paarung vor!");
      team21.focus();
      return false;
    }
    else { Teams[team21.value] = team21.value; }

//9.Spiel>

  // nur wenn nicht markiert
  if (! onlyBL.checked) {

// 2. Bundesliga
//<10. Spiel

    // date10
    if(date10.value == "")  {
      alert("Fehlende Eingabe für das Datum des 10. Spiels!");
      date10.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date10.value.charAt(0) < "0" || date10.value.charAt(0) > "9") chkZ = -1;
    if (date10.value.charAt(1) < "0" || date10.value.charAt(1) > "9") chkZ = -1;
    if (date10.value.charAt(2) != ".") chkZ = -1;
    if (date10.value.charAt(3) < "0" || date10.value.charAt(3) > "9") chkZ = -1;
    if (date10.value.charAt(4) < "0" || date10.value.charAt(4) > "9") chkZ = -1;
    if (date10.value.charAt(5) != ".") chkZ = -1;
    if (date10.value.charAt(6) < "0" || date10.value.charAt(6) > "9") chkZ = -1;
    if (date10.value.charAt(7) < "0" || date10.value.charAt(7) > "9") chkZ = -1;
    if (date10.value.charAt(8) < "0" || date10.value.charAt(8) > "9") chkZ = -1;
    if (date10.value.charAt(9) < "0" || date10.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 10. Spiels!");
      date10.focus();
      return false;
    }

    // hour10
    if(hour10.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 10. Spiels!");
      hour10.focus();
      return false;
    } // if

    if (hour10.value.charAt(0) < "0" || hour10.value.charAt(0) > "9") chkZ = -1;
    if ( (hour10.value.charAt(1) < "0" || hour10.value.charAt(1) > "9") && hour10.value.charAt(1) != "") chkZ = -1;
    if (hour10.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 10. Spiels!");
      hour10.focus();
      return false;
    }

    // min10
    if(min10.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 10. Spiels!");
      min10.focus();
      return false;
    } // if

    if (min10.value.charAt(0) < "0" || min10.value.charAt(0) > "9") chkZ = -1;
    if ( (min10.value.charAt(1) < "0" || min10.value.charAt(1) > "9") && min10.value.charAt(1) != "") chkZ = -1;
    if (min10.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 10. Spiels!");
      min10.focus();
      return false;
    }

    // team10
    if (team10.value == 0) {
      alert("Bitte Heimteam für 10. Spiel wählen!");
      team10.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team10.value] != 0) {
      alert("Heimteam des 10. Spiels kommt bereits in anderer Paarung vor!");
      team10.focus();
      return false;
    }
    else { Teams[team10.value] = team10.value; }

    // team22
    if (team22.value == 0) {
      alert("Bitte Gastteam für 10. Spiel wählen!");
      team22.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team22.value] != 0) {
      alert("Gastteam des 10. Spiels kommt bereits in anderer Paarung vor!");
      team22.focus();
      return false;
    }
    else { Teams[team22.value] = team22.value; }

//10.Spiel>

//<11. Spiel

    // date11
    if(date11.value == "")  {
      alert("Fehlende Eingabe für das Datum des 11. Spiels!");
      date11.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date11.value.charAt(0) < "0" || date11.value.charAt(0) > "9") chkZ = -1;
    if (date11.value.charAt(1) < "0" || date11.value.charAt(1) > "9") chkZ = -1;
    if (date11.value.charAt(2) != ".") chkZ = -1;
    if (date11.value.charAt(3) < "0" || date11.value.charAt(3) > "9") chkZ = -1;
    if (date11.value.charAt(4) < "0" || date11.value.charAt(4) > "9") chkZ = -1;
    if (date11.value.charAt(5) != ".") chkZ = -1;
    if (date11.value.charAt(6) < "0" || date11.value.charAt(6) > "9") chkZ = -1;
    if (date11.value.charAt(7) < "0" || date11.value.charAt(7) > "9") chkZ = -1;
    if (date11.value.charAt(8) < "0" || date11.value.charAt(8) > "9") chkZ = -1;
    if (date11.value.charAt(9) < "0" || date11.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 11. Spiels!");
      date11.focus();
      return false;
    }

    // hour11
    if(hour11.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 11. Spiels!");
      hour11.focus();
      return false;
    } // if

    if (hour11.value.charAt(0) < "0" || hour11.value.charAt(0) > "9") chkZ = -1;
    if ( (hour11.value.charAt(1) < "0" || hour11.value.charAt(1) > "9") && hour11.value.charAt(1) != "") chkZ = -1;
    if (hour11.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 11. Spiels!");
      hour11.focus();
      return false;
    }

    // min11
    if(min11.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 11. Spiels!");
      min11.focus();
      return false;
    } // if

    if (min11.value.charAt(0) < "0" || min11.value.charAt(0) > "9") chkZ = -1;
    if ( (min11.value.charAt(1) < "0" || min11.value.charAt(1) > "9") && min11.value.charAt(1) != "") chkZ = -1;
    if (min11.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 11. Spiels!");
      min11.focus();
      return false;
    }

    // team11
    if (team11.value == 0) {
      alert("Bitte Heimteam für 11. Spiel wählen!");
      team11.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team11.value] != 0) {
      alert("Heimteam des 11. Spiels kommt bereits in anderer Paarung vor!");
      team11.focus();
      return false;
    }
    else { Teams[team11.value] = team11.value; }

    // team23
    if (team23.value == 0) {
      alert("Bitte Gastteam für 11. Spiel wählen!");
      team23.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team23.value] != 0) {
      alert("Gastteam des 11. Spiels kommt bereits in anderer Paarung vor!");
      team23.focus();
      return false;
    }
    else { Teams[team23.value] = team23.value; }

//11.Spiel>

//<12. Spiel

    // date12
    if(date12.value == "")  {
      alert("Fehlende Eingabe für das Datum des 12. Spiels!");
      date12.focus();
      return false;
    } // if

    var chkZ = 1;

    if (date12.value.charAt(0) < "0" || date12.value.charAt(0) > "9") chkZ = -1;
    if (date12.value.charAt(1) < "0" || date12.value.charAt(1) > "9") chkZ = -1;
    if (date12.value.charAt(2) != ".") chkZ = -1;
    if (date12.value.charAt(3) < "0" || date12.value.charAt(3) > "9") chkZ = -1;
    if (date12.value.charAt(4) < "0" || date12.value.charAt(4) > "9") chkZ = -1;
    if (date12.value.charAt(5) != ".") chkZ = -1;
    if (date12.value.charAt(6) < "0" || date12.value.charAt(6) > "9") chkZ = -1;
    if (date12.value.charAt(7) < "0" || date12.value.charAt(7) > "9") chkZ = -1;
    if (date12.value.charAt(8) < "0" || date12.value.charAt(8) > "9") chkZ = -1;
    if (date12.value.charAt(9) < "0" || date12.value.charAt(9) > "9") chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für das Datum des 12. Spiels!");
      date12.focus();
      return false;
    }

    // hour12
    if(hour12.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 12. Spiels!");
      hour12.focus();
      return false;
    } // if

    if (hour12.value.charAt(0) < "0" || hour12.value.charAt(0) > "9") chkZ = -1;
    if ( (hour12.value.charAt(1) < "0" || hour12.value.charAt(1) > "9") && hour12.value.charAt(1) != "") chkZ = -1;
    if (hour12.value > 23) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 12. Spiels!");
      hour12.focus();
      return false;
    }

    // min12
    if(min12.value == "")  {
      alert("Fehlende Eingabe für die Uhrzeit des 12. Spiels!");
      min12.focus();
      return false;
    } // if

    if (min12.value.charAt(0) < "0" || min12.value.charAt(0) > "9") chkZ = -1;
    if ( (min12.value.charAt(1) < "0" || min12.value.charAt(1) > "9") && min12.value.charAt(1) != "") chkZ = -1;
    if (min12.value > 59) chkZ = -1;

    if (chkZ == -1) {
      alert("Keine gültige Eingabe für die Uhrzeit des 12. Spiels!");
      min12.focus();
      return false;
    }

    // team12
    if (team12.value == 0) {
      alert("Bitte Heimteam für 12. Spiel wählen!");
      team12.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team12.value] != 0) {
      alert("Heimteam des 12. Spiels kommt bereits in anderer Paarung vor!");
      team12.focus();
      return false;
    }
    else { Teams[team12.value] = team12.value; }

    // team24
    if (team24.value == 0) {
      alert("Bitte Gastteam für 12. Spiel wählen!");
      team24.focus();
      return false;
    }

    // kommt Team schon vor?
    if (Teams[team24.value] != 0) {
      alert("Gastteam des 12. Spiels kommt bereits in anderer Paarung vor!");
      team24.focus();
      return false;
    }
    else { Teams[team24.value] = team24.value; }

//12.Spiel>

  } // if (! checked


  } // with

}

//user_enter_play1.php
function chk_user_play1() {

  var ziffern = "0123456789";

   with (document.play) {

//<1. Spiel

    for (i=0;i<bet1.value.length;i++) {
      if ((ziffern.indexOf(bet1.value.charAt(i)) == -1) && (bet1.value != "-1")) {
        alert("Keine gültige Eingabe für das 1. Spiel!");
        bet1.focus();
        return false;
      }
    }

//<1. Spiel

    for (i=0;i<bet13.value.length;i++) {
      if ((ziffern.indexOf(bet13.value.charAt(i)) == -1) && (bet13.value != "-1")) {
        alert("Keine gültige Eingabe für das 1. Spiel!");
        bet13.focus();
        return false;
      }
    }

//<2. Spiel

    for (i=0;i<bet2.value.length;i++) {
      if ((ziffern.indexOf(bet2.value.charAt(i)) == -1) && (bet2.value != "-1")) {
        alert("Keine gültige Eingabe für das 2. Spiel!");
        bet2.focus();
        return false;
      }
    }

//<2. Spiel

    for (i=0;i<bet14.value.length;i++) {
      if ((ziffern.indexOf(bet14.value.charAt(i)) == -1) && (bet14.value != "-1")) {
        alert("Keine gültige Eingabe für das 2. Spiel!");
        bet14.focus();
        return false;
      }
    }

//<3. Spiel

    for (i=0;i<bet3.value.length;i++) {
      if ((ziffern.indexOf(bet3.value.charAt(i)) == -1) && (bet3.value != "-1")) {
        alert("Keine gültige Eingabe für das 3. Spiel!");
        bet3.focus();
        return false;
      }
    }

//<3. Spiel

    for (i=0;i<bet15.value.length;i++) {
      if ((ziffern.indexOf(bet15.value.charAt(i)) == -1) && (bet15.value != "-1")) {
        alert("Keine gültige Eingabe für das 3. Spiel!");
        bet15.focus();
        return false;
      }
    }

//<4. Spiel

    for (i=0;i<bet4.value.length;i++) {
      if ((ziffern.indexOf(bet4.value.charAt(i)) == -1) && (bet4.value != "-1")) {
        alert("Keine gültige Eingabe für das 4. Spiel!");
        bet4.focus();
        return false;
      }
    }

//<4. Spiel

    for (i=0;i<bet16.value.length;i++) {
      if ((ziffern.indexOf(bet16.value.charAt(i)) == -1) && (bet16.value != "-1")) {
        alert("Keine gültige Eingabe für das 4. Spiel!");
        bet16.focus();
        return false;
      }
    }

//<5. Spiel

    for (i=0;i<bet5.value.length;i++) {
      if ((ziffern.indexOf(bet5.value.charAt(i)) == -1) && (bet5.value != "-1")) {
        alert("Keine gültige Eingabe für das 5. Spiel!");
        bet5.focus();
        return false;
      }
    }

//<5. Spiel

    for (i=0;i<bet17.value.length;i++) {
      if ((ziffern.indexOf(bet17.value.charAt(i)) == -1) && (bet17.value != "-1")) {
        alert("Keine gültige Eingabe für das 5. Spiel!");
        bet17.focus();
        return false;
      }
    }

//<6. Spiel

    for (i=0;i<bet6.value.length;i++) {
      if ((ziffern.indexOf(bet6.value.charAt(i)) == -1) && (bet6.value != "-1")) {
        alert("Keine gültige Eingabe für das 6. Spiel!");
        bet6.focus();
        return false;
      }
    }

//<6. Spiel

    for (i=0;i<bet18.value.length;i++) {
      if ((ziffern.indexOf(bet18.value.charAt(i)) == -1) && (bet18.value != "-1")) {
        alert("Keine gültige Eingabe für das 6. Spiel!");
        bet18.focus();
        return false;
      }
    }

//<7. Spiel

    for (i=0;i<bet7.value.length;i++) {
      if ((ziffern.indexOf(bet7.value.charAt(i)) == -1) && (bet7.value != "-1")) {
        alert("Keine gültige Eingabe für das 7. Spiel!");
        bet7.focus();
        return false;
      }
    }

//<7. Spiel

    for (i=0;i<bet19.value.length;i++) {
      if ((ziffern.indexOf(bet19.value.charAt(i)) == -1) && (bet19.value != "-1")) {
        alert("Keine gültige Eingabe für das 7. Spiel!");
        bet19.focus();
        return false;
      }
    }

//<8. Spiel

    for (i=0;i<bet8.value.length;i++) {
      if ((ziffern.indexOf(bet8.value.charAt(i)) == -1) && (bet8.value != "-1")) {
        alert("Keine gültige Eingabe für das 8. Spiel!");
        bet8.focus();
        return false;
      }
    }

//<8. Spiel

    for (i=0;i<bet20.value.length;i++) {
      if ((ziffern.indexOf(bet20.value.charAt(i)) == -1) && (bet20.value != "-1")) {
        alert("Keine gültige Eingabe für das 8. Spiel!");
        bet20.focus();
        return false;
      }
    }

//<9. Spiel

    for (i=0;i<bet9.value.length;i++) {
      if ((ziffern.indexOf(bet9.value.charAt(i)) == -1) && (bet9.value != "-1")) {
        alert("Keine gültige Eingabe für das 9. Spiel!");
        bet9.focus();
        return false;
      }
    }

//<9. Spiel

    for (i=0;i<bet21.value.length;i++) {
      if ((ziffern.indexOf(bet21.value.charAt(i)) == -1) && (bet21.value != "-1")) {
        alert("Keine gültige Eingabe für das 9. Spiel!");
        bet21.focus();
        return false;
      }
    }

//<10. Spiel

    for (i=0;i<bet10.value.length;i++) {
      if ((ziffern.indexOf(bet10.value.charAt(i)) == -1) && (bet10.value != "-1")) {
        alert("Keine gültige Eingabe für das 10. Spiel!");
        bet10.focus();
        return false;
      }
    }

//<10. Spiel

    for (i=0;i<bet22.value.length;i++) {
      if ((ziffern.indexOf(bet22.value.charAt(i)) == -1) && (bet22.value != "-1")) {
        alert("Keine gültige Eingabe für das 10. Spiel!");
        bet22.focus();
        return false;
      }
    }

//<11. Spiel

    for (i=0;i<bet11.value.length;i++) {
      if ((ziffern.indexOf(bet11.value.charAt(i)) == -1) && (bet11.value != "-1")) {
        alert("Keine gültige Eingabe für das 11. Spiel!");
        bet11.focus();
        return false;
      }
    }

//<11. Spiel

    for (i=0;i<bet23.value.length;i++) {
      if ((ziffern.indexOf(bet23.value.charAt(i)) == -1) && (bet23.value != "-1")) {
        alert("Keine gültige Eingabe für das 11. Spiel!");
        bet23.focus();
        return false;
      }
    }

//<12. Spiel

    for (i=0;i<bet12.value.length;i++) {
      if ((ziffern.indexOf(bet12.value.charAt(i)) == -1) && (bet12.value != "-1")) {
        alert("Keine gültige Eingabe für das 12. Spiel!");
        bet12.focus();
        return false;
      }
    }

//<12. Spiel

    for (i=0;i<bet24.value.length;i++) {
      if ((ziffern.indexOf(bet24.value.charAt(i)) == -1) && (bet24.value != "-1")) {
        alert("Keine gültige Eingabe für das 12. Spiel!");
        bet24.focus();
        return false;
      }
    }

  } // with
} // function


function chk_admin_results1(){

  var ziffern = "0123456789";

  with (document.play) {

//<1. Spiel

    if ((res1.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 1. Spiel!");
      res1.focus();
      return false;
    } // if
if (res1.value != ""){
    for (i=0;i<res1.value.length;i++) {
      if ((ziffern.indexOf(res1.value.charAt(i)) == -1) && (res1.value != "-1")) {
        alert("Keine gültige Eingabe für das 1. Spiel!");
        res1.focus();
        return false;
      }
    }
}
//<1. Spiel

    if ((res13.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 1. Spiel!");
      res13.focus();
      return false;
    } // if

    for (i=0;i<res13.value.length;i++) {
      if ((ziffern.indexOf(res13.value.charAt(i)) == -1) && (res13.value != "-1")) {
        alert("Keine gültige Eingabe für das 1. Spiel!");
        res13.focus();
        return false;
      }
    }

//<2. Spiel

    if ((res2.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 2. Spiel!");
      res2.focus();
      return false;
    } // if

    for (i=0;i<res2.value.length;i++) {
      if ((ziffern.indexOf(res2.value.charAt(i)) == -1) && (res2.value != "-1")) {
        alert("Keine gültige Eingabe für das 2. Spiel!");
        res2.focus();
        return false;
      }
    }

//<2. Spiel

    if ((res14.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 2. Spiel!");
      res14.focus();
      return false;
    } // if

    for (i=0;i<res14.value.length;i++) {
      if ((ziffern.indexOf(res14.value.charAt(i)) == -1) && (res14.value != "-1")) {
        alert("Keine gültige Eingabe für das 2. Spiel!");
        res14.focus();
        return false;
      }
    }

//<3. Spiel

    if ((res3.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 3. Spiel!");
      res3.focus();
      return false;
    } // if

    for (i=0;i<res3.value.length;i++) {
      if ((ziffern.indexOf(res3.value.charAt(i)) == -1) && (res3.value != "-1")) {
        alert("Keine gültige Eingabe für das 3. Spiel!");
        res3.focus();
        return false;
      }
    }

//<3. Spiel

    if ((res15.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 3. Spiel!");
      res15.focus();
      return false;
    } // if

    for (i=0;i<res15.value.length;i++) {
      if ((ziffern.indexOf(res15.value.charAt(i)) == -1) && (res15.value != "-1")) {
        alert("Keine gültige Eingabe für das 3. Spiel!");
        res15.focus();
        return false;
      }
    }

//<4. Spiel

    if ((res4.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 4. Spiel!");
      res4.focus();
      return false;
    } // if

    for (i=0;i<res4.value.length;i++) {
      if ((ziffern.indexOf(res4.value.charAt(i)) == -1) && (res4.value != "-1")) {
        alert("Keine gültige Eingabe für das 4. Spiel!");
        res4.focus();
        return false;
      }
    }

//<4. Spiel

    if ((res16.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 4. Spiel!");
      res16.focus();
      return false;
    } // if

    for (i=0;i<res16.value.length;i++) {
      if ((ziffern.indexOf(res16.value.charAt(i)) == -1) && (res16.value != "-1")) {
        alert("Keine gültige Eingabe für das 4. Spiel!");
        res16.focus();
        return false;
      }
    }

//<5. Spiel

    if ((res5.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 5. Spiel!");
      res5.focus();
      return false;
    } // if

    for (i=0;i<res5.value.length;i++) {
      if ((ziffern.indexOf(res5.value.charAt(i)) == -1) && (res5.value != "-1")) {
        alert("Keine gültige Eingabe für das 5. Spiel!");
        res5.focus();
        return false;
      }
    }

//<5. Spiel

    if ((res17.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 5. Spiel!");
      res17.focus();
      return false;
    } // if

    for (i=0;i<res17.value.length;i++) {
      if ((ziffern.indexOf(res17.value.charAt(i)) == -1) && (res17.value != "-1")) {
        alert("Keine gültige Eingabe für das 5. Spiel!");
        res17.focus();
        return false;
      }
    }


//<6. Spiel

    if ((res6.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 6. Spiel!");
      res6.focus();
      return false;
    } // if

    for (i=0;i<res6.value.length;i++) {
      if ((ziffern.indexOf(res6.value.charAt(i)) == -1) && (res6.value != "-1")) {
        alert("Keine gültige Eingabe für das 6. Spiel!");
        res6.focus();
        return false;
      }
    }

//<6. Spiel

    if ((res18.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 6. Spiel!");
      res18.focus();
      return false;
    } // if

    for (i=0;i<res18.value.length;i++) {
      if ((ziffern.indexOf(res18.value.charAt(i)) == -1) && (res18.value != "-1")) {
        alert("Keine gültige Eingabe für das 6. Spiel!");
        res18.focus();
        return false;
      }
    }


//<7. Spiel

    if ((res7.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 7. Spiel!");
      res7.focus();
      return false;
    } // if

    for (i=0;i<res7.value.length;i++) {
      if ((ziffern.indexOf(res7.value.charAt(i)) == -1) && (res7.value != "-1")) {
        alert("Keine gültige Eingabe für das 7. Spiel!");
        res7.focus();
        return false;
      }
    }

//<7. Spiel

    if ((res19.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 7. Spiel!");
      res19.focus();
      return false;
    } // if

    for (i=0;i<res19.value.length;i++) {
      if ((ziffern.indexOf(res19.value.charAt(i)) == -1) && (res19.value != "-1")) {
        alert("Keine gültige Eingabe für das 7. Spiel!");
        res19.focus();
        return false;
      }
    }


//<8. Spiel

    if ((res8.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 8. Spiel!");
      res8.focus();
      return false;
    } // if

    for (i=0;i<res8.value.length;i++) {
      if ((ziffern.indexOf(res8.value.charAt(i)) == -1) && (res8.value != "-1")) {
        alert("Keine gültige Eingabe für das 8. Spiel!");
        res8.focus();
        return false;
      }
    }

//<8. Spiel

    if ((res20.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 8. Spiel!");
      res20.focus();
      return false;
    } // if

    for (i=0;i<res20.value.length;i++) {
      if ((ziffern.indexOf(res20.value.charAt(i)) == -1) && (res20.value != "-1")) {
        alert("Keine gültige Eingabe für das 8. Spiel!");
        res20.focus();
        return false;
      }
    }


//<9. Spiel

    if ((res9.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 9. Spiel!");
      res9.focus();
      return false;
    } // if

    for (i=0;i<res9.value.length;i++) {
      if ((ziffern.indexOf(res9.value.charAt(i)) == -1) && (res9.value != "-1")) {
        alert("Keine gültige Eingabe für das 9. Spiel!");
        res9.focus();
        return false;
      }
    }

//<9. Spiel

    if ((res21.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 9. Spiel!");
      res21.focus();
      return false;
    } // if

    for (i=0;i<res21.value.length;i++) {
      if ((ziffern.indexOf(res21.value.charAt(i)) == -1) && (res21.value != "-1")) {
        alert("Keine gültige Eingabe für das 9. Spiel!");
        res21.focus();
        return false;
      }
    }


//<10. Spiel

    if ((res10.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 10. Spiel!");
      res10.focus();
      return false;
    } // if

    for (i=0;i<res10.value.length;i++) {
      if ((ziffern.indexOf(res10.value.charAt(i)) == -1) && (res10.value != "-1")) {
        alert("Keine gültige Eingabe für das 10. Spiel!");
        res10.focus();
        return false;
      }
    }

//<10. Spiel

    if ((res22.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 10. Spiel!");
      res16.focus();
      return false;
    } // if

    for (i=0;i<res22.value.length;i++) {
      if ((ziffern.indexOf(res22.value.charAt(i)) == -1) && (res22.value != "-1")) {
        alert("Keine gültige Eingabe für das 10. Spiel!");
        res22.focus();
        return false;
      }
    }


//<11. Spiel

    if ((res11.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 11. Spiel!");
      res11.focus();
      return false;
    } // if

    for (i=0;i<res11.value.length;i++) {
      if ((ziffern.indexOf(res11.value.charAt(i)) == -1) && (res11.value != "-1")) {
        alert("Keine gültige Eingabe für das 11. Spiel!");
        res11.focus();
        return false;
      }
    }

//<11. Spiel

    if ((res23.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 11. Spiel!");
      res23.focus();
      return false;
    } // if

    for (i=0;i<res23.value.length;i++) {
      if ((ziffern.indexOf(res23.value.charAt(i)) == -1) && (res23.value != "-1")) {
        alert("Keine gültige Eingabe für das 11. Spiel!");
        res23.focus();
        return false;
      }
    }


//<12. Spiel

    if ((res12.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 12. Spiel!");
      res12.focus();
      return false;
    } // if

    for (i=0;i<res12.value.length;i++) {
      if ((ziffern.indexOf(res12.value.charAt(i)) == -1) && (res12.value != "-1")) {
        alert("Keine gültige Eingabe für das 12. Spiel!");
        res12.focus();
        return false;
      }
    }

//<12. Spiel

    if ((res24.value == "") && (free.checked == 1))  {
      alert("Fehlende Eingabe für das 12. Spiel!");
      res24.focus();
      return false;
    } // if

    for (i=0;i<res24.value.length;i++) {
      if ((ziffern.indexOf(res24.value.charAt(i)) == -1) && (res24.value != "-1")) {
        alert("Keine gültige Eingabe für das 12. Spiel!");
        res24.focus();
        return false;
      }
    }



  } // with document.play


} // chk_admin_results1(){

function chk_user_profile(){

  var email_chars = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_.@-";

  with (document.user_profile) {

    for (i=0;i<tmp_email.value.length;i++) {
      if (email_chars.indexOf(tmp_email.value.charAt(i)) == -1){
        alert("Keine gültige Eingabe für die Email-Adresse!");
        tmp_email.focus();
        return false;
      }
    } // for

    if (((tmp_email.value.indexOf("@") == -1) || (tmp_email.value.indexOf(".") == -1)) || (tmp_email.value.indexOf("@") > tmp_email.value.lastIndexOf("."))){
      alert("Keine gültige Eingabe für die Email-Adresse!");
      tmp_email.focus();
      return false;
    }

    // passwörter vergleichen
    if ((pass1.value.length > 0) || (pass2.value.length > 0)) {
      if (pass1.value != pass2.value) {
        alert("Die eingebenen Passwörter stimmen nicht überein!");
        pass1.focus();
        return false;
      } // if

	  var ZugelasseneZeichen = new String("abcdefghijklmnopqrstuvwxyz");
      ZugelasseneZeichen += ZugelasseneZeichen.toUpperCase() + "0123456789.,!";
  	
  	  var retValue = PruefeZeichen(document.user_profile.pass1, ZugelasseneZeichen, "");
  	  if ( retValue == "false" ) {
	  	//alert('fa');
  		//alert(retValue);
  		return false;
  	  } else {
  	    //alert('tr');
  	    //alert(retValue);
  	  }

    } // if


  } // with

}


  function PruefeZeichen(Feld, ZugelasseneZeichen, FehlerMeldung) {
	  for (var Pos = 0; Pos < Feld.value.length; Pos++) {
	    if (ZugelasseneZeichen.indexOf(Feld.value.charAt(Pos)) == -1) {
	      FehlerMeldung += "Die Eingabe enth\xE4lt ein verbotenes Zeichen: '";
	      FehlerMeldung += Feld.value.charAt(Pos);
	      FehlerMeldung += "'.\nNur diese Zeichen sind erlaubt:\n";
	      FehlerMeldung += ZugelasseneZeichen;
	      
	      alert(FehlerMeldung);
	      Feld.focus();
	      return "false";
	      }
	    }
	    return "true";
  }


function chk_admin_teams(){

}
