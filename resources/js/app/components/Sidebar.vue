<template>
    <div class="sidebar">
        <div class="sidebar-menu">
            <ul>
                <li class="header">
                    <strong>Menu</strong>
                </li>
                <li class="treeview">
                    <router-link to="/home" :class="{'active' : this.$route.path === '/home'}" class="treeview-link">
                        <span>Home</span>
                    </router-link>
                </li>
                <li class="treeview">
                    <router-link to="/news/edit/0" :class="{'active' : this.$route.path === '/news/edit/0'}" class="treeview-link">
                        <span>Create News</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style lang="scss">
    .sidebar {
        padding: 0;
        margin: 0;
        position: fixed;
        overflow-y: auto;
        overflow-x: hidden;
        width: 14rem;
        height: 100%;
        z-index: 999;
        background-color: #fff;
        box-shadow: 1px 0 10px rgba(0, 0, 0, 0.2);
        color: #86939e;
        letter-spacing: .4px;

        .sidebar-menu {
            list-style: outside none none;
            white-space: nowrap;

            ul {
                padding: 0;

                .treeview {
                    list-style: none;
                    cursor: pointer;

                    .treeview-link {
                        text-decoration: none;
                        font-size: 12px;
                        color: #86939e;
                        padding: 1rem 0 1rem 1.5rem;
                        display: block;
                        border-bottom: 1px solid #f8f8f8;

                        &.active {
                            background-color: #1a75ff!important;
                            color: #fff;
                        }

                        &:hover {
                            background-color: #f5f8fa;
                        }
                    }
                }

                .header {
                    background-color: #f5f8fa;
                    display: block;
                    padding: 1rem 0 1rem 1.5rem;
                    font-size: 12px;
                }
            }
        }
    }
</style>
