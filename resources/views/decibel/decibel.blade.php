@extends('default')
@section('css')
<link rel="stylesheet" href="/css/decibel.css">
@endsection
@section('js')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
        window.onload = function () {
        const modal = document.getElementById("myModal");
        const btn1 = document.getElementById("btn1");
        const btn2 = document.getElementById("btn2");
        const chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "dark1",
            backgroundColor: "#0e0e0e",
            lineColor: "red",
            title: {
                fontSize: 18,
                padding: 3,
                fontFamily: "OpenSans-SemiBold",
                text: "Decibel"
            },
            axisY: {
                title: "Decibel waardes",
            },
            data: [{
                type: "splineArea",
                lineColor: "#7f22ea",
                color: "rgb(155,34,234,0.6)",
                indexLabelFontSize: 16,
                dataPoints: [
                    {y: {{$decibel[0]->waardes}}, label:" " },
                    {y: {{$decibel[1]->waardes}}, label:" " },
                    {y: {{$decibel[2]->waardes}}, label:" " },
                    {y: {{$decibel[3]->waardes}}, label:" " },
                    {y: {{$decibel[4]->waardes}}, label:" " },
                    {y: {{$decibel[5]->waardes}}, label:" " },
                    {y: {{$decibel[6]->waardes}}, label:" " },
                    {y: {{$decibel[7]->waardes}}, label:" " },
                    {y: {{$decibel[8]->waardes}}, label:" " },
                    {y: {{$decibel[9]->waardes}}, label:" " }
                ]
            }]
        });
        chart.render();
        trimDownValues();

        const decibelTip = @json($avgDecibel);
        console.log(decibelTip);   
        if(decibelTip > 30) {
            modal.style.display = "flex"; 
        } else {
            modal.style.display = "none"; 
        }
        

        btn2.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

        function trimDownValues(){
            avgdecibel = String({{$avgDecibel}})
            document.getElementById("js--avgdecibel").innerHTML = avgdecibel + " dB"
        }
    }    
   
</script>
@endsection
@section('content')

    <main>
        <section class="heading">
            <article class="heading__article">
                <h1 class="heading__title">Dashboard</h1>
                <h3 class="heading__info">Decibel</h3>
            </article>
        </section> 

        <section id="myModal" class="modal" tabindex="-1">
            <div class="modal-content" aria-labelledby="myModal">
                <h2 class="modal__title modal__title--color-red" tabindex="0">Waarschuwing !</h2>
                <h3 class="modal__h3"> Teveel geluid in je omgeving!</h3>
                <p class="modal__text">- Sluit je af van de buitenwereld en gebruik een goed afsluitende koptelfoon met oortjes.</p>
                <p class="modal__text">- Doe de ramen dicht om het geluid van buiten te verminderen.</p>
                <p class="modal__text">- Doe de deuren dicht om het geluid van je huisgenoten te verminderen.</p>
                <p class="modal__text">- Koop een koptelefoon of oortjes met goede ruisonderdrukking zodat jij gefocust kan werken.</p>
                <button class="modal__btn" id="btn2"> Gelezen</button>
                <figure class="modal__figure">
                    <img src="images/decibel.svg" alt="decibel bird tips">
                </figure>
            </div>
        </section>

        <section class="decibel">
        <section class="charts">
            <article class="charts__article">
                <h4 class="charts__title">Mininum Decibel</h4>
                <h3 class="charts__value">{{$minDecibel}}dB</h3>
            </article>

            <article class="charts__article">
                <h4 class="charts__value">Max Decibel</h4>
                <h3 class="charts__value">{{$maxDecibel}}dB</h3>
            </article>

            <article class="charts__article">
                <h4 class="charts__value">Gemiddelde Decibel</h4>
                <h3 class="charts__value" id="js--avgdecibel">{{$avgDecibel}}</h3>
            </article>
            
            <article class="charts__article charts__article--border" id="chartContainer">
                
            </article>
        </section>
        
        <section class="nietStoren">
                <article class="nietStoren__article">
                    <h3 class="nietStoren__title">Niet storen modus</h3>
                    <p class="nietStoren__text">Slide de knop uit zodat je kinderen een melding krijgen dat ze je weer mogen storen.</p>
                
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider" onclick="window.location.href='/nietstoren'"></span>
                </label>
            </article>
        </section>


        </section>
    </main>

@endsection

