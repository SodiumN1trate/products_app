<template>
  <div class="header">
    <canvas id="canvas" width="130px" height="30px"></canvas>
    <h6>{{ title }}</h6>
  </div>
</template>

<script>
export default {
  name: 'Header',
  props: ['title'],
  mounted: function () {
    const canvas = document.getElementById('canvas')
    const ctx = canvas.getContext('2d')
    ctx.beginPath()
    ctx.arc(10, 15, 5, 0, 2 * Math.PI, false)
    ctx.fillStyle = '#666666'
    ctx.arc(25, 15, 5, 0, 2 * Math.PI, false)
    ctx.fillStyle = '#666666'
    ctx.arc(40, 15, 5, 0, 2 * Math.PI, false)
    ctx.fillStyle = '#666666'
    ctx.fill()
  }
}
</script>

<style>
.header {
  display: flex;
  flex-direction: row;
  width: 100%;
  height: 30px;
  background-color: #424242;
  align-items: center;
  font-family: Arial;
}

#canvas {
  position: absolute;
}

.header > h6 {
  color: white;
  color: white;
  flex-grow: 2;
  text-align: center;
  font-weight: lighter;
}

</style>
