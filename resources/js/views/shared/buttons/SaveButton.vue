<template>
    <button
    :class="mobile ? 'btn btn-green shadow-sm rounded-md' : 'btn btn-green shadow-sm rounded-md'"
    :btntype="btntype"
    >
    {{label}}
</button>
</template>

<script>
export default {
    name: "SaveButton",
    props: {
        mobile: {
            type: Boolean,
            default: false,
        },
        /* class: {
            type: String,
            required: true,
        }, */
        /* icon: {
            type: String,
            required: true,
        }, */
        btntype: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
    }
}
</script>