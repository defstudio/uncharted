<?php
$id = "uncharted-" . Str::uuid();
?>

<canvas id="{{$id}}" width="{{$width}}" height="{{$height}}"></canvas>
<script>
    new Chart(document.getElementById('{{$id}}').getContext('2d'), @json($chart->config()));
</script>
