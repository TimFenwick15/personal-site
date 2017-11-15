@foreach ($cards as $card)
  <div class="card invisible {{ $card['type'] === 'Data' ? 'red' : 'blue' }}" tabindex="1">
    <div class="headline">{{ $card['headline'] }}</div>
    <br>
    <div class="caption">{{ $card['caption'] }}</div>
    @if ($card['main_content_url'])
        <a href="{{ $card['main_content_url'] }}">Link</a>
    @endif
  </div>
@endforeach
