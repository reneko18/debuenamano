import { defineStore } from "pinia";

export const useFormStore = defineStore("form", {
    state: () => ({
        formData: {
            stepOneNameProduct: "",
            stepOneCategoryProduct: "",
            stepOneGenre: "",
            stepOneAgeIni: "",
            stepOneAgeDateIni: "",
            stepOneAgeFin: "",
            stepOneAgeDateFin: "",
            stepOneDescriptionProduct: "",
            stepTwoBrandProduct: "",
            stepTwoModelProduct: "",
            stepThreeHeight: "",
            stepThreeHeightUnit: "",
            stepThreeWidth: "",
            stepThreeWidthUnit: "",
            stepThreeLength: "",
            stepThreeLengthUnit: "",
            stepThreeWeight: "",
            stepThreeWeightUnit: "",
            stepThreeBox: "",
            stepFourState: "",
            stepFourUsageTime: "",
            stepFourUsageUnit: "",
            stepFiveDetails: "",
            stepFiveAdvice: "",
            //Photo
            stepSixPhoto: [],
            //Delivery and price Step 1
            stepSevenOptionDelivery: "Chilexpress",
            stepSevenRegion: "",
            stepSevenCity: "",
            stepSevenChilexpressOffice: "",
            stepSevenStreet: "",
            stepSevenStreetNumber: "",
            //Delivery and price Step 2
            stepEightPrice: "",
            //Delivery and price Step 3
            stepNineName: "",
            stepNineBank: "",
            stepNineBankNumber: "",
            stepNineRut: "",
            stepNineBankType: "",
        },
        characterCount: 0,
        characterCountObs: 0,
        characterCountReco: 0,
    }),
    actions: {
        setFormData(formData) {
            this.formData = { ...this.formData, ...formData };
        },
        setCharacterCount(count) {
            this.characterCount = count;
        },
        setCharacterCountObs(count) {
            this.characterCountObs = count;
        },
        setCharacterCountReco(count) {
            this.characterCountReco = count;
        },
        /*resetForm() {
        this.formData = {
          name: '',
          brand: '',
          test: '',
        };
      },*/
    },
});
