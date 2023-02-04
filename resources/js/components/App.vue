<template>
    <div>
        <Gallery/>
        <CandidateForm/>
    </div>
</template>
<script>
import Gallery from './Gallery.vue';
import CandidateForm from './CandidateForm';

export default {
    components: {
        Gallery, CandidateForm
    },
    name: 'App',
}
</script>
