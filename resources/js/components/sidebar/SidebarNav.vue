<template>
	<!-- begin sidebar nav -->
	<ul class="nav" v-if="menus">
		<li class="nav-header">Navigation</li>
    <sidebar-nav-list v-for="menu in menus" ref="sidebarNavList" v-bind:menu="menu" v-bind:scrollTop="scrollTop" v-bind:key="menu.path" v-bind:status="menu.status" v-on:collapse-other="handleCollapseOther(menu)"></sidebar-nav-list>
		<!-- begin sidebar minify button -->
		<li><a href="javascript:;" class="sidebar-minify-btn" v-on:click="handleSidebarMinify()"><i class="fa fa-angle-double-left"></i></a></li>
		<!-- end sidebar minify button -->
	</ul>
	<!-- end sidebar nav -->
</template>

<script>
import SidebarMenu from './SidebarMenu.vue';
import SidebarNavList from './SidebarNavList.vue';
import PageOptions from '../PageOptions.vue';

export default {
	name: 'SidebarNav',
	props: ['scrollTop'],
	components: {
		SidebarNavList
	},
	data () {
		return {
			menus: SidebarMenu,
			pageOptions: PageOptions
		}
	},
	methods: {
		handleCollapseOther: function(menu) {
			for (var i = 0; i < this.menus.length; i++) {
				this.$refs.sidebarNavList[i].collapse(menu);
			}
		},
		handleSidebarMinify: function() {
			this.pageOptions.pageSidebarMinified = !this.pageOptions.pageSidebarMinified;
		}
	}
}
</script>
