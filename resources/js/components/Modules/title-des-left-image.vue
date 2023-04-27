<template>
    
    <Title style="top:10%; left:5%" />

    <Image style="top:calc(10% + 50px); left:2%" class="w-1/2 h-20">
        
    </Image>
    
    <Des style="top:calc(10% + 50px); left:55%" />

</template>

<script>

import Image from './image.vue';
import Title from './title.vue';
import Des from './des.vue';

export default {
    components: {
        Image,
        Title,
        Des,
    }
}
</script>