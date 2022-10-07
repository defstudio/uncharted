<?php
    $id = "uncharted-" . Str::uuid();
?>

<canvas id="{{$id}}" width="{{$width}}" height="{{$height}}"></canvas>
<script>
    const ctx = document.getElementById('{{$id}}').getContext('2d');
    const myChart = new Chart(ctx, @json($chart->config()));
</script>
