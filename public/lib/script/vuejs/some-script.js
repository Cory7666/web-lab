import { createApp, nextTick } from "./vue.esm-browser.js";
import { Photo } from "../Photo.js";
import { ImageFrame } from "../ImageFrame.js";

const app = createApp({
  data()
  {
    return {
      id: -1,
      photos: [
        new Photo("Image 1", "/lib/image/album/image1.png"),
        new Photo("Image 2", "/lib/image/album/image2.jpg"),
        new Photo("Image 3", "/lib/image/album/image3.jpg"),
        new Photo("Image 4", "/lib/image/album/image4.jpg"),
        new Photo("Image 5", "/lib/image/album/image5.jpg"),
        new Photo("Image 6", "/lib/image/album/image6.jpg"),
        new Photo("Image 7", "/lib/image/album/image7.jpg"),
        new Photo("Image 8", "/lib/image/album/image8.png"),
        new Photo("Image 9", "/lib/image/album/image9.jpg"),
        new Photo("Image 10", "/lib/image/album/image10.jpg"),
        new Photo("Image 11", "/lib/image/album/image11.png"),
        new Photo("Image 12", "/lib/image/album/image12.jpg"),
        new Photo("Image 13", "/lib/image/album/image13.jpg"),
        new Photo("Image 14", "/lib/image/album/image14.jpg"),
        new Photo("Image 15", "/lib/image/album/image15.jpg")
      ]
    };
  },

  mounted()
  {
    console.log("Mounted!");
  }
});

app.component("album-item", {
  props: ['package'],
  template: `
    <li>
      <div class="image-frame" onclick="new ImageFrame(photos, index).show();">
        <div class="if-content">
          <img :src="package.url" :alt="package.title" :title="package.title" />
        </div>
        <div class="if-title">
          /{{ package.title }}
        </div>
      </div>
    </li>
  `
});

app.component("img-popup", {
  props: ['photos', 'index'],
  template: `
    <teleport to="body">
      <div
        class="img_popup"
        @click.self="$emit('close')"
      >
        <button
          type="button"
          class="to_left"
          @click="previos"
        >&#8249;</button>
        
        <div class="content">
          <img
            :src="photos[id].photo"
            :alt="photos.alt" />
          <div class="text">
            <h2>{{photos[id].title}}</h2>
            <p>{{photos[id].comment}}</p>
          </div>
        </div>
        
        <button
          type="button"
          class="to_right"
          @click="next">&#8250;</button>
      </div>
    </teleport>
  `,

  data()
  {
    return {
      id: this.$props.index
    };
  },

  methods:
  {
    previous()
    {
      if (this.id > 0)
      {
        this.id = this.$props.data.length - 1;
      }
      else
      {
        --this.id;
      }
    },

    next()
    {
      if (this.id == this.$props.data.length - 1)
      {
        this.id = 0;
      }
      else
      {
        ++this.id;
      }
    }
  }
});

app.mount("#app");
