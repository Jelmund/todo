<template>
    <div class="taskListContainer">
        <div class="heading">
            <h2 id="title">Task list</h2>
            <add-task-form></add-task-form>
        </div>
        <list-view></list-view>
    </div>
</template>
<script>
import addTaskForm from "./addTaskForm";
import listView from "./listView";
export default {
    components: {
        addTaskForm,
        listView
    }
}
</script>

<style>
.taskListContainer {
    width: 350px;
    margin: auto;
}

.heading {
    background: white;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>
