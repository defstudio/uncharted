<?php
    $id = "uncharted-" . Str::uuid();
?>

<canvas id="{{$id}}" width="400" height="400"></canvas>
<script>
    const ctx = document.getElementById('{{$id}}').getContext('2d');
    const myChart = new Chart(ctx, @json($chart->config()));
</script>
