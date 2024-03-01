import { defineStore } from "pinia";

export const useFormStore = defineStore("form", {
    state: () => ({
        formData: {
            stepOneNameProduct: "",
            stepOneCategoryProduct: "",
            stepOneGenre: "",
            stepOneShowFirstInput:true,
            stepOneAgeIni: "",
            stepOneAgeDateIni: "Meses",
            stepOneAgeFin: "",
            stepOneAgeDateFin: "Meses",
            stepOneDescriptionProduct: "",
            stepTwoBrandProduct: "",
            stepTwoModelProduct: "",
            stepThreeHeight: "",
            stepThreeHeightUnit: "cm",
            stepThreeWidth: "",
            stepThreeWidthUnit: "cm",
            stepThreeLength: "",
            stepThreeLengthUnit: "cm",
            stepThreeWeight: "",
            stepThreeWeightUnit: "g",
            stepThreeBox: "",
            stepFourState: "",
            stepFourUsageTime: "",
            stepFourUsageUnit: "Dias",
            stepFiveDetails: "",
            stepFiveAdvice: "",
            //Photo
            stepSixPhoto: [],
            //Delivery and price Step 1
            stepSevenSelectedSection: "Chilexpress",
            stepSevenOptionDelivery: "Chilexpress",
            stepSevenRegion: "",
            stepSevenCity: "",
            stepSevenChilexpressOffice: "",
            stepSevenStreet: "",
            stepSevenStreetNumber: "",
            stepSevenStreetDptoHouse: "",
            //Delivery and price Step 2
            stepEightPrice: "",
            stepEightPriceFee: 0,
            stepEightPriceFinalAmount: 0,
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
        formCart:{
            firstname: '',
            lastname:'',
            email:'',
            phone:'',
            street:'',
            region:'',
            city:'',
            total:'',
        },
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
