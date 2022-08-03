<template>
  <main class="a__propos">

        <section class="a__propos__intro" >
            <h2>A propos</h2>
            <p>
                Cat To Home est un site web dédié à la sensibilisation au problème de l’abandon d’animaux et se veut être une solution complémentaire aux refuges pour permettre l’adoption d’un animal et mettant en relation des particuliers propriétaires d’animaux et des personnes souhaitant en adopter.

                L'idée de ce projet nous viens de Damien, notre cher product owner. Pourquoi ? Parce qu'il aime beaucoup les chats ! Il paraît que c'est bon les chats, surtout cuisiné en civet ou à la moutarde, un peu comme du lapin mais avec un gout plus prononcé. 

                Ah.. On me dit dans l'oreillette que je ne suis pas sur un site de cuisine ! RAssurez-vous donc Damien ni aucun membre de l'équipe ne va manger vos chatons ! Les bébés dans le congélateur ok, mais manger des chats c'est pas ok ! OK ??
            </p>
            <img class="img__about" src="@/assets/img/purr-9.png" alt="illustration de 2 chats et un aquarium">

        </section>

        <section class="a__propos__team">
            <h2>L'équipe des chatons</h2>
            <div class="dev impair">
                <div class="dev__photo" v-bind:style="{'backgroundImage': 'url(' + require('../../assets/img/equipe-damien.jpg') + ')', 'backgroundSize': 'cover', 'backgroundPosition': 'center'}">
                </div>
                <div class="dev__presentation">
                    <h3>Damien, le Product Owner</h3>
                    <p>She shook her head, and shook it again, as if trying to clear it, which is what she was trying to do. They did not realize that because of the quasi-reciprocal and circular nature of all Improbability calculations, anything that was Infinitely Improbable was actually very likely to happen almost immediately. If beauty is in the eye of the beholder, then the beholder won’t be a Vogon, because even Vogons know how ugly they are. Think of something crazy, or if that’s too taxing just throw random adjectives and nouns together. He smiled the smile that Zaphod had wanted to hit and this time Zaphod hit it.</p>
                </div>
            </div>
            <div class="dev pair">
                <div class="dev__photo img__steph" v-bind:style="{'backgroundImage': 'url(' + require('../../assets/img/Steph-Pongo.jpg') + ')', 'backgroundSize': 'cover'}">
                </div>
                <div class="dev__presentation">
                    <h3>Stéphane, le Lead Dev Back</h3>
                    <p>She shook her head, and shook it again, as if trying to clear it, which is what she was trying to do. They did not realize that because of the quasi-reciprocal and circular nature of all Improbability calculations, anything that was Infinitely Improbable was actually very likely to happen almost immediately. If beauty is in the eye of the beholder, then the beholder won’t be a Vogon, because even Vogons know how ugly they are. Think of something crazy, or if that’s too taxing just throw random adjectives and nouns together. He smiled the smile that Zaphod had wanted to hit and this time Zaphod hit it.</p>
                </div>
            </div>            
            <div class="dev impair">
                <div class="dev__photo" v-bind:style="{'backgroundImage': 'url(' + require('../../assets/img/equipe-pierre.jpg') + ')', 'backgroundSize': 'cover', 'backgroundPosition': 'center'}">
                </div>
                <div class="dev__presentation">
                    <h3>Pierre, le Référent Git</h3>
                    <p>She shook her head, and shook it again, as if trying to clear it, which is what she was trying to do. They did not realize that because of the quasi-reciprocal and circular nature of all Improbability calculations, anything that was Infinitely Improbable was actually very likely to happen almost immediately. If beauty is in the eye of the beholder, then the beholder won’t be a Vogon, because even Vogons know how ugly they are. Think of something crazy, or if that’s too taxing just throw random adjectives and nouns together. He smiled the smile that Zaphod had wanted to hit and this time Zaphod hit it.</p>
                </div>
            </div>
            <div class="dev pair">
                <div class="dev__photo" v-bind:style="{'backgroundImage': 'url(' + require('../../assets/img/equipe-chloe.jpg') + ')', 'backgroundSize': 'cover', 'backgroundPosition': 'center'}">
                </div>
                <div class="dev__presentation">
                    <h3>Chloé, la Scrum Master</h3>
                    <p>She shook her head, and shook it again, as if trying to clear it, which is what she was trying to do. They did not realize that because of the quasi-reciprocal and circular nature of all Improbability calculations, anything that was Infinitely Improbable was actually very likely to happen almost immediately. If beauty is in the eye of the beholder, then the beholder won’t be a Vogon, because even Vogons know how ugly they are. Think of something crazy, or if that’s too taxing just throw random adjectives and nouns together. He smiled the smile that Zaphod had wanted to hit and this time Zaphod hit it.</p>
                </div>
            </div>            <div class="dev impair">
                <div class="dev__photo" v-bind:style="{'backgroundImage': 'url(' + require('../../assets/img/equipe-antoine.jpg') + ')', 'backgroundSize': 'cover', 'backgroundPosition': 'center'}">
                </div>
                <div class="dev__presentation">
                    <h3>Antoine, le Lead Dev Front</h3>
                    <p>She shook her head, and shook it again, as if trying to clear it, which is what she was trying to do. They did not realize that because of the quasi-reciprocal and circular nature of all Improbability calculations, anything that was Infinitely Improbable was actually very likely to happen almost immediately. If beauty is in the eye of the beholder, then the beholder won’t be a Vogon, because even Vogons know how ugly they are. Think of something crazy, or if that’s too taxing just throw random adjectives and nouns together. He smiled the smile that Zaphod had wanted to hit and this time Zaphod hit it.</p>
                </div>
            </div>

        </section>
        

    </main>
</template>

<script>
export default {
    name: "AboutLayout",
    data() {
        return{
            damien: '../../assets/img/equipe-damien.jpg',
            stephane: '../../assets/img/Steph-Pongo.jpg',
            pierre: '../../assets/img/equipe-pierre.jpg',
            chloe: '../../assets/img/equipe-chloe.jpg',
            antoine: '../../assets/img/equipe-antoine.jpg'
        }
    }
}
</script>

<style lang="scss" scoped>

   @media screen and (max-width: 480px) {
  .img__about{
        width: 80vw;
    }
  }
@media screen and (max-width: 769px) {
  .img__steph{
    background-position: center center;
    }
}
 @media screen and (min-width: 767px) and (max-width: 900px){
    .img__steph{
        background-position: -40rem;
        }
  }
   @media screen and (min-width: 901px) and (max-width: 1100px){
    .img__steph{
        background-position: -25rem;
        }
  }
  @media screen and (min-width: 1101px){
    .img__steph{
        background-position: center center;
    }
  }

</style>