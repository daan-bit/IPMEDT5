@extends('default')
@section('css')
<link rel="stylesheet" href="/css/templucht.css">
@endsection
@section('js')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
        //Wat variabelen
        var menuOpen = false;
        var valueMessage;
       
        //Wanneer de pagina laadt
        window.onload = function () {     
        loadValues();  
        inputAge();

        //Maakt de temperatuur grafiek aan
        var chart1 = new CanvasJS.Chart("chartContainerTemp", {
            animationEnabled: true,
            theme: "light2",
            title:{
                fontSize: 18,
                text: "Laatste temperatuur waarden"
            },
            axisX:{
                
                title: "<- Oud   Tijdlijn   Nieuw ->"
            },
            axisY:{
                title: "Temperatuur (°C)",
                includeZero: true
            },
            data: [{        
                type: "area",
                indexLabelFontSize: 16,
                dataPoints: [
                    {y: {{$sum[0]->temperature}}, label: " " },
                    {y: {{$sum[1]->temperature}}, label: " " },
                    {y: {{$sum[2]->temperature}}, label: " " },
                    {y: {{$sum[3]->temperature}}, label: " " },
                    {y: {{$sum[4]->temperature}}, label: " " },
                    {y: {{$sum[5]->temperature}}, label: " " },
                    {y: {{$sum[6]->temperature}}, label: " " },
                    {y: {{$sum[7]->temperature}}, label: " " },
                    {y: {{$sum[8]->temperature}}, label: " " },
                    {y: {{$sum[9]->temperature}}, label: " " },
                    {y: {{$sum[10]->temperature}}, label: " " },
                    {y: {{$sum[11]->temperature}}, label: " " }
                ]
            }]
        });

        //Maakt de luchtvochtigheid grafiek aan
        var chart2 = new CanvasJS.Chart("chartContainerHum", {
            animationEnabled: true,
            theme: "light2",
            title:{
                fontSize: 18,
                text: "Laatste luchtvochtigheid waarden"
            },
            axisX:{
                title: "<- Oud   Tijdlijn   Nieuw   ->"
            },
            axisY:{
                title: "Luchtvochtigheid (%)",
                includeZero: true
            },
            data: [{        
                type: "area",
                indexLabelFontSize: 16,
                dataPoints: [
                    {y: {{$sum[0]->humidity}}, label: " " },
                    {y: {{$sum[1]->humidity}}, label: " " },
                    {y: {{$sum[2]->humidity}}, label: " " },
                    {y: {{$sum[3]->humidity}}, label: " " },
                    {y: {{$sum[4]->humidity}}, label: " " },
                    {y: {{$sum[5]->humidity}}, label: " " },
                    {y: {{$sum[6]->humidity}}, label: " " },
                    {y: {{$sum[7]->humidity}}, label: " " },
                    {y: {{$sum[8]->humidity}}, label: " " },
                    {y: {{$sum[9]->humidity}}, label: " " },
                    {y: {{$sum[10]->humidity}}, label: " " },
                    {y: {{$sum[11]->humidity}}, label: " " }
                ]
            }]
        });

        //Laat beide grafieken zien
        chart1.render();
        chart2.render();
       
       
        //Kijkt naar de verschillen van de gewenste temperatuur met de gemeten waarden 
        var tempdif = {{$cur->temperature}} - {{$pref->gewensttemp}} 
        const tempMargin = [-1, 1, -2, -3, 2, 3]
        var tempResult = checkdif(tempdif, tempMargin);

        //Kijkt naar de verschillen van de gewenste luchtvochtigheid met de gemeten waarden 
        var humdif = {{$cur->humidity}} - {{$pref->gewensthum}}
        const humMargin = [-4, 4, -5, -10, 5, 10]
        var humResult = checkdif(humdif, humMargin);

        //Gaat kijken of de verschillende bepaalde waarden heeft overschreden
        showNote(tempResult, humResult);
        checkSubmit();

        //Verandert real time de html van de ingevoerde leeftijd
        var age = document.getElementById("-js--preference--age--input").value;
        document.getElementById("-js--preference--age").innerHTML = "Uw leeftijd: " + age;
        trimDownValues();
      
     }

     //Kijkt naar welke schaal het verschil is van de temperatuur/luchtvochtigheid waarden en gemeten waarden 
     function checkdif(thing, margin){
        if(thing >= margin[0] && thing <= margin[1]){
            valueMessage = "good";
        } else if(thing <= margin[2] && thing > margin[3]){
            valueMessage = "low";
        } else if(thing >= margin[4] && thing < margin[5]){
            valueMessage = "high";
        } else if(thing <= margin[3]){
            valueMessage = "tooLow";
        } else if(thing >= margin[5]){
            valueMessage = "tooHigh"; 
        } 
        return valueMessage;
     }

    
     //Zet de ingevoerde waardes in de settings als standaard als de pagina herlaad
     function loadValues(){
        document.getElementById("-js--preference--age--input").value = "{{ $pref->age }}"
        document.getElementById("-js--preference--temp--input").value = "{{ $pref->gewensttemp }}"
        document.getElementById("-js--preference--hum--input").value = "{{ $pref->gewensthum }}"

        console.log(document.getElementById("-js--preference--age--input").value)
        console.log(document.getElementById("-js--preference--temp--input").value)
        console.log(document.getElementById("-js--preference--hum--input").value)
     }


     //Als je de settings submit, kijk of de waardes tussen de min-max zitten 
     //schrijf true naar localstorage dat settings aangepast zijn
     function submitForm(){
        var age = document.forms["settingsForm"]["age"].value;
        var temp = document.forms["settingsForm"]["gewensttemp"].value;
        var hum = document.forms["settingsForm"]["gewensthum"].value;
        if(age >= 0 && age <= 120 && temp >= -20 && temp <= 50 && hum >= 0 && hum <= 100){
            localStorage.setItem("submit", "true");
            document.getElementById("-js--form").submit();
            location.reload();
        }

        localStorage.setItem("submit", "true");
     }

     //Als pagina herladen is, kijken in localstorage of de settings aangepast zijn
     //Laat melding zien dat settings zijn aangepast
     function checkSubmit(){
        if(localStorage.getItem("submit") == "true"){
            document.getElementById("-js--submitted").style.height  = "7rem";
            localStorage.setItem("submit", "false");
            setTimeout(function(){ document.getElementById("-js--submitted").style.height = "0rem"}, 5000);
        }
     }

     //Kijkt of de temperatuur/humidity te hoog/hoog/laag/te laag is
     function showNote(noteTemp, noteHum){
        var tempMessage;
        var humMessage;
        switch (noteTemp){
            case "tooLow":
                tempMessage = "Temperatuur te laag!"
                giveWarning(tempMessage, "temp", "too low");
                break;
            case "low":
                tempMessage = "Temperatuur laag!"
                giveWarning(tempMessage, "temp", "low");
                break;
            case "high":
                tempMessage = "Temperatuur hoog!"
                giveWarning(tempMessage, "temp", "high");
                break;
            case "tooHigh":
                tempMessage = "Temperatuur te hoog!"
                giveWarning(tempMessage, "temp", "too high");
                break;
            default:
                console.log("Temp just right")
                break;
        }

        switch (noteHum){
            case "tooLow":
                humMessage = "Luchtvochtigheid te laag!"
                giveWarning(humMessage, "hum", "too low");
                break;
            case "low":
                humMessage = "Luchtvochtigheid laag!"
                giveWarning(humMessage, "hum", "low");
                break;
            case "high":
                humMessage = "Luchtvochtigheid hoog!"
                giveWarning(humMessage, "hum", "high");
                break;
            case "tooHigh":
                humMessage = "Luchtvochtigheid te hoog!"
                giveWarning(humMessage, "hum", "too high");
                break;
            default:
                console.log("Hum just right")
                break;
        }
        console.log(tempMessage)
        console.log(humMessage)
     }

     //Geeft de specifieke waarde mee aan de warning en wat die moet laten zien
     function giveWarning(message, object, value){
        openNotification();
        document.getElementById("-js--notification").style.display = "block";
        switch (object){
            case "temp":
            console.log(value)
                document.getElementById("-js--notification--warning--temp").innerHTML = message;
                document.getElementById("-js--notification--temp").style.display = "block";
                document.getElementById("-js--notification--warning--temp").style.display = "block";
                switch(value){
                    case "too low":
                        setDisplay("-js--notification--content--temp--toolow");
                        setDisplay("-js--notification--content--temp--low");
                        break;
                    case "low":
                        setDisplay("-js--notification--content--temp--low");
                        break;
                    case "high":
                        setDisplay("-js--notification--content--temp--high");
                        break;
                    case "too high":
                        setDisplay("-js--notification--content--temp--high");
                        setDisplay("-js--notification--content--temp--toohigh");
                        break;
                }
                break;
            case "hum":
                console.log(value)
                document.getElementById("-js--notification--warning--hum").innerHTML = message;
                document.getElementById("-js--notification--hum").style.display = "block";
                document.getElementById("-js--notification--warning--hum").style.display = "block";
                switch(value){
                    case "too low":
                        setDisplay("-js--notification--content--hum--toolow")
                        setDisplay("-js--notification--content--hum--low")
                        break;
                    case "low":
                        setDisplay("-js--notification--content--hum--low")
                        break;
                    case "high":
                        setDisplay("-js--notification--content--hum--high")
                        break;
                    case "too high":
                        setDisplay("-js--notification--content--hum--high")
                        setDisplay("-js--notification--content--hum--toohigh")
                        break;
                }
                break;
        }

     }

     //Geeft aanbevolen waarden op basis van de ingevoerde leeftijd
     function inputAge(){
        var recommended
        var recommend = document.getElementById("-js--preference--recommended")
        var age = document.getElementById("-js--preference--age--input").value;
        document.getElementById("-js--preference--age").innerHTML = "Uw leeftijd: " + age;
        if(age <= 10){
            recommended = "Aanbevolen Temperatuur is 20-23 °C <br> Aanbevolen luchtvochtigheid is tussen 45-55%"
        } else if(age > 10 && age < 50){
            recommended = "Aanbevolen Temperatuur is 18-20 °C <br> Aanbevolen luchtvochtigheid is tussen 40-60%"
        } else if(age >= 50){
            recommended = "Aanbevolen Temperatuur is 20-23 °C <br> Aanbevolen luchtvochtigheid is tussen 50-60%"
        }
        recommend.innerHTML = recommended;
     }

     //Laat de meegegeven tips zien
     function setDisplay(id){ 
         console.log(id)
        document.getElementById(id).style.display = "block";
     }


     //opent de warning notificatie
     function openNotification(){
        console.log(document.getElementById("-js--notification").scrollHeight )
        document.getElementById("-js--notification--backdrop").style.display = "block";
        setTimeout(function(){ document.getElementById("-js--notification").style.height = document.getElementById("-js--notification").scrollHeight + 100 + "px"}, 100);
        setTimeout(function(){ document.getElementById("-js--notification--close").style.display= "block"}, 300);
     }

     //sluit de warning notificatie
     function closeNotification(){
        document.getElementById("-js--notification--close").style.display= "none";
        document.getElementById("-js--notification").style.height = "0px";
        document.getElementById("-js--notification").style.borderRadius = "2.5rem";  
        document.getElementById("-js--notification--backdrop").style.display= "none" 
     }

     //haalt de 4 decimalen van de avg weg
     function trimDownValues(){
        temp = String(Math.round({{$avgTemp}}))
        hum = String(Math.round({{$avgHum}}))
        document.getElementById("-js--average--temp").innerHTML = "Temperatuur: " + temp + " °Celsius"
        document.getElementById("-js--average--hum").innerHTML = "Luchtvochtigheid: " +  hum + "%"
        }

    </script>
@endsection
@section('content')

<main>
    <section class="heading">
        <article class="heading__article">
            <h1 class="heading__title">Dashboard</h1>
            <h3 class="heading__info">Templucht</h3>
        </article>
    </section> 

    <section class = "templucht">
        <div class="templucht__submitted" id="-js--submitted">
            <p>Settings aangepast!</p>
        </div>

        <div class="templucht__backdrop" id="-js--notification--backdrop" onclick="closeNotification()"></div>
        <article class="templucht__notification templucht__article" id="-js--notification">
            <h1 class="templucht__notification__title">! WARNING !</h1>
                <section class="templucht__notification__section" id="-js--notification--temp">
                    <h2 class="templucht_hide" id="-js--notification--warning--temp">Notification</h2>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--temp--toohigh">
                        <li>Eet een ijsje.</li>
                        <li>Open ramen.</li>
                        <li>Doe een airconditioner aan.</li>
                        <li>Doe een ventilator aan.</li>
                    </ul>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--temp--high">
                        <li>Drink een koud glas water.</li>
                        <li>Doe sweater/vest uit.</li>
                        <li>Open deuren.</li>
                    </ul>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--temp--low">
                        <li>Drink wat thee.</li>
                        <li>Doe een sweater/vest aan.</li>
                    </ul>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--temp--toolow">
                        <li>Sluit ramen.</li>
                        <li>Doe de verwarming aan.</li>
                    </ul>
                </section>
                <section class="templucht__notification__section" id="-js--notification--hum">
                    <h2 class="templucht_hide"  id="-js--notification--warning--hum">Notification</h2>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--hum--toohigh">
                        <li>Doe een ventilator aan.</li>
                        <li>Doe een airconditioner aan.</li>
                        <li>Doe een luchtontvochtiger aan.</li>
                    </ul>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--hum--high">
                        <li>Zorg voor wat luchtstroom.</li>
                        <li>Zet wat plantjes neer.</li>
                    </ul>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--hum--low">
                        <li>Zet een emmer water neer.</li>
                        <li>Zet wat plantjes neer</li>
                        <li>Doe de verwarming uit.</li>
                    </ul>
                    <ul class="templucht__notification__section__list templucht_hide" id="-js--notification--content--hum--toolow">
                        <li>Doe een luchtvochtiger aan.</li>
                        <li>Open een raam (als het regent)</li>
                    </ul>
                
                </section>
            <button class="templucht__notification__close" id="-js--notification--close" onclick="closeNotification()">Sluit</button>
        </article>
        
        

        <section class="templucht__main">
            <article class ="templucht__main__article">
                <h2>Nieuwste waarden</h2>
                <h3>Temperatuur: {{$cur->temperature}} °Celsius</h3>
                <h3>Luchtvochtigheid: {{$cur->humidity}}%   </h3>
                <h4>Opgenomen op: {{$cur->created_at}}</h4>
                <button class="templucht_refresh" onClick="window.location.reload();">Herlaad</button>
            </article>

            <article class ="templucht__main__article">
                <h2>Voorkeur waarden</h2>
                <h3>Temperatuur {{$pref->gewensttemp}} °Celsius</h3>
                <h3>Luchtvochtigheid: {{$pref->gewensthum}}%   </h3>
            </article>

            <article class ="templucht__main__article">
                <h2>Gemiddelde waarden</h2>
                <h3 id="-js--average--temp">Temperatuur: {{$avgTemp}} °Celsius</h3>
                <h3 id="-js--average--hum">Luchtvochtigheid:    {{$avgHum}}%</h3>
            </article>

            <article class ="templucht__main__article">
            
                <h2 class = "templucht__main__article_title">Temperatuur/Luchtvochtigheid afgelopen 2 uur</h2>
                <section class="templucht__recordings">
                    <div class="templucht__recordings_tables" id="chartContainerTemp" style="height: 150px; width: 100%;"></div>
                    <div class="templucht__recordings_tables" id="chartContainerHum" style="height: 150px; width: 100%;"></div> 
                </section>
                
                
                        
            </article>

            <article class ="templucht__main__article">
                <h2>Settings</h2>
                <form class = "templucht__main__form" id="-js--form" method="POST" action="/templucht" name="settingsForm">
                    @csrf
                    
                    <label class = "templucht__main__form__label">Leeftijd: (0-120)</label>
                    <input  class = "templucht__main__form__input" name="age" id="-js--preference--age--input" type="number" min="0" max="120"  oninput="inputAge()" required>

                    <label class = "templucht__main__form__label">Voorkeur temperatuur (°C) (-20-50)</label>
                    <input class = "templucht__main__form__input" name="gewensttemp" id="-js--preference--temp--input" type="number" min="-20" max="50" required>

                    <label class = "templucht__main__form__label">Voorkeur luchtvochitgheid (%) (0-100)</label>
                    <input class = "templucht__main__form__input" name="gewensthum" id="-js--preference--hum--input"  type="number" min="0" max="100" required>

                    <h4 id="-js--preference--age">Uw leefijd: {{$pref->age}}</h4>
                    <p id="-js--preference--recommended"> </p>
                    <button class="templucht__form__submit templucht__refresh" onclick="submitForm()">Verzend</button>
                </form>
                
            </article>
        </section>
    </section>
    
    </main>
    
    
@endsection
