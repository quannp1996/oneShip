<template>
  <div class="warehouse-list">
      <search-bar></search-bar>
      <el-tabs type="border-card"  v-model="activeTab" @tab-click="handleClick">
        <el-tab-pane label="Phiếu mới" name="new_order">
            <warehouse-table></warehouse-table>
        </el-tab-pane>
        <el-tab-pane label="Chờ xử lý" name="waitting_order">
            <warehouse-table></warehouse-table>
        </el-tab-pane>
        <el-tab-pane label="Đã hoàn thành" name="complete_order">
           <warehouse-table></warehouse-table>
        </el-tab-pane>
        <el-tab-pane label="Đã hủy" name="cancel_order">
           <warehouse-table></warehouse-table>
        </el-tab-pane>
      </el-tabs>
  </div>
</template>


<script src="./WarehouseList.js"></script>
