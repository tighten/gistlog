<template>
    <div class="flex">
        <div class="w-1/3 flex-col">
            <slot name="tabs"></slot>
        </div>

        <div class="w-2/3">
            <slot name="tab-content"></slot>
        </div>
    </div>
</template>

<script>

export default {

}
</script>

