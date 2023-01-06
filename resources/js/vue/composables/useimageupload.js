import {ref, watch } from 'vue';

export function useimageupload(){
    const imagefile = ref();
    const imageUrl = ref();

    const onFileChanged = (e) => {
        if(e.target.files.lenght === 0){
            imagefile.value = "";
            imageUrl.value = "";
        }
            imagefile.value = e.target.files[0];
    };

    watch(imagefile,(imagefile) => {
        if(!(imagefile instanceof File)){
            return;
        }
        let fileReader = new FileReader();
        fileReader.readAsDataURL(imagefile);
        fileReader.addEventListener('load', ()=> {
            imageUrl.value = fileReader.result;
        });
    });

    return {
        imageUrl,
        imagefile,
        onFileChanged
    };
}