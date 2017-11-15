@foreach ($cards as $card)
  <div class='card invisible'>{{ $card['text'] }}</div>
@endforeach