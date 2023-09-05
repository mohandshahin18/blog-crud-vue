<template>
    <div v-if="isLoading" class="loader">
        <div class="loader-spinner"></div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isLoading: false,
        };
    },
    created() {
        this.$router.beforeEach((to, from, next) => {
            this.isLoading = true;
            next();
        });

        this.$router.afterEach(() => {
            setTimeout(() => {
                this.isLoading = false;
            }, 500);
        });
    },
};
</script>

<style>
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader-spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
