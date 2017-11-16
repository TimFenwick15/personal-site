@foreach ($cards as $card)
  <div class="card invisible {{ $card['type'] === 'Data' ? 'red' : 'blue' }}" tabindex="1">
    @if ($card['image_url'])
      <img src="{{ $card['image_url'] }}" height="50"></img>
    @else
      <div class="headline">{{ $card['headline'] }}</div>
    @endif
    <br>
    <div class="caption">{{ $card['caption'] }}</div>
    @if ($card['main_content_url'])
        <a href="{{ $card['main_content_url'] }}" target="_blank">Read more...</a>
    @endif
  </div>
@endforeach
