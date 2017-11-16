@foreach ($cards as $card)
  <div class="card invisible" tabindex="1">
    <div class="image-circle">
      <img src="{{ $card['image_url'] ? $card['image_url'] : asset('image/placeholder.png') }}"></img>
    </div>
    <div class="headline">{{ $card['headline'] }}</div>
    <div class="caption">{{ $card['caption'] }}</div>
    @if ($card['main_content_url'])
      <div class="read-more"><a href="{{ $card['main_content_url'] }}" target="_blank">Read more...</a></div>
    @endif
  </div>
@endforeach
