<div class="ad-container @if($adStyle) {{ $adStyle }} @endif">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9390772892463957"
     crossorigin="anonymous"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "{{ $adClient }}",
            google_ad_slot: "{{ $adSlot }}",
            google_ad_format: "{{ $adFormat }}",
            @if($adResponsive) google_ad_responsive: true @endif
        });
    </script>
</div>
