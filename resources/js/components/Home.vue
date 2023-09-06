<template>
    <div class="container px-5">
        <div class="row d-flex justify-content-center text-start">
            <div class="col-md-6">
                <form action="">
                    <div class="col-md-12">
                        <div class="my-4">
                            <textarea
                                name=""
                                class="form-control my-4"
                                id=""
                                cols="10"
                                rows="4"
                            ></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary px-4">Post</button>
                </form>
            </div>
        </div>

        <div class="post">
            <div class="header">
                <img
                    :src="`/images/143140922416939292432021_10_14_07_32_IMG_7378.JPG`"
                    class="avatar"
                    alt=""
                />
                <h6>mohanad</h6>
            </div>
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Corrupti odio perferendis vero nihil animi esse. Ab quae tenetur
                laudantium provident quibusdam accusamus, temporibus est. Earum
                maiores amet in architecto impedit.
            </p>
            <div class="divider my-2"></div>

            <div class="content">
                <span :class="{ liked: liked }" @click="toggleLike">
                    {{ likes == 0 ? "" : likes }}
                    <i class="fa-solid fa-thumbs-up"></i>Like</span
                >
                <span @click="toggleComment()"
                    ><i class="fa-solid fa-comment"></i>Comment</span
                >
            </div>

            <div class="divider my-2"></div>
            <div class="commentForm my-2" v-if="showComment">
                <form action="">
                    <input
                        class="form-control"
                        placeholder="Add new comment"
                        type="text"
                        autofocus
                    />
                </form>
            </div>

            <div class="comments my-3">
                <div class="header" style="padding-top: 10px">
                    <img
                        :src="`/images/143140922416939292432021_10_14_07_32_IMG_7378.JPG`"
                        class="avatar avatarComment"
                    />
                </div>

                <div class="info">
                    <p class="name">mohanad</p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing
                        elit. Corrupti odio perferendis vero nihil animi esse.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showComment: false,
            liked: false,
            likes: 0,
        };
    },
    methods: {
        toggleComment() {
            this.showComment = true;
        },
        toggleLike() {
            this.liked = !this.liked;
            if (this.liked) {
                this.likes++;
            } else {
                this.likes--;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.avatar {
    width: 45px;
    height: 45px;
    object-fit: contain;
    border: 1px solid #aaa;
    border-radius: 50%;
}
.avatarComment {
    width: 30px !important;
    height: 30px !important;
}
.container {
    background-color: #f0f2f5 !important;
    .post {
        width: 50%;
        margin: 40px auto;
        background: #fff;
        padding: 15px;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #b7b7b7b0;

        .header {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        .content {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 10px;
            span {
                color: #65676b;
                cursor: pointer;
                i {
                    margin-right: 5px;
                }
            }
            .liked {
                color: #007bff; /* Change the background color when liked */
            }
        }

        .divider {
            border: 1px solid #e0e0e0b0;
            width: 100%;
        }
        .commentForm {
            width: 100%;
        }

        .comments {
            display: flex;
            gap: 10px;
            p.name {
                font-weight: 500;
                margin-bottom: 7px;
            }

            .info {
                background-color: #f0f2f5;
                padding: 8px;
                border-radius: 8px;
                p {
                    font-size: 14px;
                }
            }
        }
    }
}
</style>
