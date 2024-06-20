<template>
    <div class="position-relative" v-click-outside-element="closeDropdownDbmStatic">
        <div class="position-relative div-select-static">
            <input
                type="text"
                class="form-control cat-select"
                :value="selectedNameStatic"
                @click="showAndCloseDropdownDbmStatic"
                readonly
                :placeholder="placeholder"
            />
            <font-awesome-icon
                :icon="['fas', 'chevron-down']"
                @click="showAndCloseDropdownDbmStatic"
            />
        </div>
        <div id="dropdown-select-static">
            <div v-for="item in items" :key="item.id">
                <div>
                    <input
                      :id="item.value + '-' + item.id"
                      class="btn-check"
                      :value="item.value"
                      type="radio"
                      name="categoria"
                      v-model="selectedItemStatic"
                      @change="emitSelectionStatic"
                    />
                    <label :for="item.value + '-' + item.id" class="btn">
                    {{ item.name }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, watch, computed } from 'vue';

const props = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
  selected: {
    type: String,
    default: '',
  },
  placeholder: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:selected-static']);

const selectedItemStatic = ref(props.selected);
const dropdownVisibleDbmStatic = ref(false);

const selectedNameStatic = computed(() => {
  const selectedItem = props.items.find(item => item.value === selectedItemStatic.value);
  return selectedItem ? selectedItem.name : '';
});

const showAndCloseDropdownDbmStatic = () => {
  if (dropdownVisibleDbmStatic.value == false) {
        dropdownVisibleDbmStatic.value = true;
        TweenMax.fromTo(
            "#dropdown-select-static",
            0.55,
            {
                autoAlpha: 0,
                y: -10,
            },
            {
                autoAlpha: 1,
                y: 0,
                ease: Power2.easeOut,
            }
        );
    } else {
        dropdownVisibleDbmStatic.value = false;
        TweenMax.to("#dropdown-select-static", 0.2, {
            autoAlpha: 0,
            y: -10,
            ease: Power2.easeOut,
        });
    }
};

const closeDropdownDbmStatic = () => {
    dropdownVisibleDbmStatic.value = false;
    TweenMax.to("#dropdown-select-static", 0.2, {
        autoAlpha: 0,
        y: -10,
        ease: Power2.easeOut,
    });
};


const emitSelectionStatic = () => {
  emit('update:selected-static', selectedItemStatic.value);
};

watch(() => props.selected, (newVal) => {
  selectedItemStatic.value = newVal;
});

watch(selectedItemStatic, (newVal) => {
  emit('update:selected-static', newVal);
});

</script>