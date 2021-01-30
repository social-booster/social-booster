<template>
<div>
    <h1 class="document-title">{{ title }}</h1>
    <hr>
    <slot></slot>
</div>
</template>

<script>
export default {
  props: {
    title: String
  }
}
</script>
