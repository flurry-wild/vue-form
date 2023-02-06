<template>
    <div class="card">
        <h1 class="m-auto p-8">Добро пожаловать в ITechDevelopment</h1>
        <Galleria :value="images" :showThumbnails=true :showItemNavigatorsOnHover=true
        :showThumbnailNavigators=true :showItemNavigators=true :circular=true>
            <template #item="slotProps">
                <img :src="slotProps.item.itemImageSrc" :alt="slotProps.item.alt" class="gallery-image" />
            </template>
            <template #thumbnail="slotProps">
                <img :src="slotProps.item.thumbnailImageSrc" :alt="slotProps.item.alt" class="panel-item"/>
            </template>
        </Galleria>
    </div>
</template>
<script>
export default {
    name: 'Gallery',
    mounted() {
        fetch('images/photos.json').then(res => res.json())
            .then(d => d.data).then(data => this.images = data);
    },
    data() {
        return {
            images: null,
        }
    }
}
</script>
<style>
.gallery-image{
    background-size: cover;
    background-position: center;
    height:65vh;
    max-width: 100%;
    background-repeat: no-repeat;
}
.panel-item{
    width:100px;
}
.p-galleria-item-container{
    background-color:#000;
}

@media (max-width: 768px) {
    .gallery-image{
        height:30vh;
    }
    .panel-item{
        width:50px;
    }
}
</style>
