@foreach ($cards as $card)
  <div class="card {{ $visible ? '' : 'invisible' }}">
    <div class="image-circle">
      <img src="{{ $card['image_url'] ? $card['image_url'] : asset('image/placeholder.png') }}"></img>
    </div>
    <div class="headline" tabindex="1">{{ $card['headline'] }}</div>
    <div class="caption" tabindex="1">{!! nl2br(e($card['caption'])) !!}</div>
    <br />
    @if ($card['source_update_time'])
      <div class="caption" tabindex="1">Updated: {{ $card['source_update_time'] }}</div>
    @endif
    @if ($card['main_content_url'])
      <div class="read-more">
        <a href="{{ $card['main_content_url'] }}" target="_blank" tabindex="1">Read more...</a>
      </div>
    @endif
  </div>
@endforeach
