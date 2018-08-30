<template>
    <div class="flex bg-white rounded-lg shadow-md my-4 py-5 px-5 cursor-pointer" @click="$emit('changeTab', index)">
        <div class="rounded-full font-bold text-white w-8 h-8 bg-blue flex items-center justify-center text-sm">{{ index }}</div>
        <div class="text-left mx-5">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        index: {
            type: String,
        }
    }
}
</script>
