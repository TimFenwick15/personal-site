@foreach ($cards as $card)
  <div class="card invisible" tabindex="1">{{ $card['text'] }}</div>
@endforeach