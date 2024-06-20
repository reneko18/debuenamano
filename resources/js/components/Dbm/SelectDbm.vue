<template>
    <div class="position-relative" v-click-outside-element="closeDropdownDbm">
        <div class="position-relative div-select">
            <input
                type="text"
                class="form-control cat-select"
                :value="selectedName"
                @click="showAndCloseDropdownDbm"
                readonly
                :placeholder="placeholder"
            />
            <font-awesome-icon
                :icon="['fas', 'chevron-down']"
                @click="showAndCloseDropdownDbm"
            />
        </div>
        <div id="dropdown-select">
            <div v-for="item in items" :key="item.id">
                <div>
                    <input
                      :id="item.name + '-' + item.id"
                      class="btn-check"
                      :value="item"
                      type="radio"
                      name="categoria"
                      v-model="selectedItem"
                      @change="emitSelection"
                    />
                    <label :for="item.name + '-' + item.id" class="btn">
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
    default: () => []
  },
  selected: {
    type: Object,
    default: () => ({})
  },
  placeholder: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:selected']);

const selectedItem = ref(props.selected);
const dropdownVisibleDbm = ref(false);

const selectedName = computed(() => selectedItem.value?.name || '');

const showAndCloseDropdownDbm = () => {
  if (dropdownVisibleDbm.value == false) {
        dropdownVisibleDbm.value = true;
        TweenMax.fromTo(
            "#dropdown-select",
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
        dropdownVisibleDbm.value = false;
        TweenMax.to("#dropdown-select", 0.2, {
            autoAlpha: 0,
            y: -10,
            ease: Power2.easeOut,
        });
    }
};

const closeDropdownDbm = () => {
    dropdownVisibleDbm.value = false;
    TweenMax.to("#dropdown-select", 0.2, {
        autoAlpha: 0,
        y: -10,
        ease: Power2.easeOut,
    });
};

// Emit the selected category when it changes
const emitSelection = () => {
  emit('update:selected', selectedItem.value);
};

// Watch for changes in the props.selected and update selectedItem
watch(() => props.selected, (newVal) => {
  selectedItem.value = newVal;
});

// Watch for changes in the selectedCategory and emit the update event
watch(selectedItem, (newVal) => {
  emit('update:selected', newVal);
});
</script>