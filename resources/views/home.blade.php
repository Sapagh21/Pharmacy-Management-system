
@include('subviews/header')
<link rel="stylesheet" href="{{asset('style/style.css')}}">
@php
$healthQuotes = [
    "<p>Health is the greatest gift, contentment the greatest wealth, faithfulness the best relationship.</p> <span class='quoted'>- Buddha</span>",
    "<p>No matter how much it gets abused, the body can restore balance. The first rule is to stop interfering with nature.</p> <span class='quoted'>- Deepak Chopra</span>",
    "<p>He who has health has hope; and he who has hope, has everything.</p> <span class='quoted'>- Thomas Carlyle</span>",
    "<p>Give a man health and a course to steer, and he’ll never stop to trouble about whether he’s happy or not.</p> <span class='quoted'>- George Bernard Shaw</span>",
    "<p>Health is a state of complete harmony of the body, mind, and spirit.</p> <span class='quoted'>- B.K.S. Iyengar</span>",
    "<p>We are what we repeatedly do. Excellence, then, is not an act, but a habit.</p> <span class='quoted'>- Will Durant</span>",
    "<p>Values are related to our emotions, just as we practice physical hygiene to preserve our physical health, we need to observe emotional hygiene to preserve a healthy mind and attitudes.</p> <span class='quoted'>- Dalai Lama</span>",
    "<p>Take care of your body. It's the only place you have to live in.</p> <span class='quoted'>- Jim Rohn</span>",
    "<p>It is health that is real wealth and not pieces of gold and silver.</p> <span class='quoted'>- Mahatma Gandhi</span>",
    "<p>Early to bed and early to rise makes a man healthy, wealthy, and wise.</p> <span class='quoted'>- Benjamin Franklin</span>",
    "<p>Nurturing yourself is not selfish – it’s essential to your survival and your well-being.</p> <span class='quoted'>- Renee Peterson Trudeau</span>",
    "<p>The human body is the best picture of the human soul.</p> <span class='quoted'>- Tony Robbins</span>",
    "<p>Eat healthily, sleep well, breathe deeply, move harmoniously.</p> <span class='quoted'>- Jean-Pierre Barral</span>",
    "<p>We know that food is a medicine, perhaps the most powerful drug on the planet with the power to cause or cure most disease.</p> <span class='quoted'>- Dr. Mark Hyman</span>",
    "<p>If you truly treat your body like a temple, it will serve you well for decades. If you abuse it, you must be prepared for poor health and a lack of energy.</p> <span class='quoted'>- Oli Hille</span>"
];

$randomQuote = $healthQuotes[array_rand($healthQuotes)];

@endphp

<div class="container">
    <section class="Home">
        <div class="welc">
            <h1>Welcome</h1>
            <h1>{{session('Name')}}! </h1>
            <p> {{session('user_type')}}</p>
        </div>

        <div class="qbox">
        <div class="quote">
            <?= $randomQuote;?>
        </div>
        </div>

        
        <ul class="buttonsAdd" >
            <li> <a href="{{route('showAddDrug')}}"> Add Drug To inventory</a> </li>
            <li> <a href="{{route('showPurchase')}}"> Make a purchase!</a> </li>
        </ul>
    </section>

</div>
    


    