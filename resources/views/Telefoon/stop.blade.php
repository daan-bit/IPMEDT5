@extends('default')
@section('css')
<link rel="stylesheet" href="css/telefoon.css">
@endsection

@section('content')
<main class="main main--telefoon" >
        <section class="heading">
            <article class="heading__article">
                <h1 class="heading__title">Dashboard</h1>
                <h3 class="heading__info">Stop</h3>
            </article>
        </section> 

        <article class="main__cardWrapper main__cardWrapper--stop">
            <section class="main__card main__card--stop">
                <h3 class="main__tekst main__tekst--status">Stopfunctie staat</h3>
                <h3 class="main__tekst main__tekst--status main__tekst--stop">{{$stop}}</h3>
                <p class="main__ondertekst">U kunt uw telefoon van de sensor afhalen</p>

                <section class="main__buttonContainer--stop">
                    <a href="/telefoon"><button class="main__button main__button--terug">Terug</button></a>             
                </section>             
            </section> 
        </article>
</main>
@endsection
