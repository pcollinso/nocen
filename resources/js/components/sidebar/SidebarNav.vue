<template>
  <!-- begin sidebar nav -->
  <ul class="nav" v-if="menus">
    <li class="nav-header">Navigation</li>
    <sidebar-nav-list
      v-for="(menu, i) in menus"
      ref="sidebarNavList"
      :menu="menu"
      :scrollTop="scrollTop"
      :key="i"
      :status="menu.status"
      @collapse-other="handleCollapseOther(menu)"
    ></sidebar-nav-list>
    <!-- begin sidebar minify button -->
    <li>
      <a href="javascript:;" class="sidebar-minify-btn" v-on:click="handleSidebarMinify()">
        <i class="fa fa-angle-double-left"></i>
      </a>
    </li>
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
			pageOptions: PageOptions,
			roles: [],
			permissions: []
		}
	},
	computed: {
		menus() {
			return SidebarMenu
				.map(path => this.reducePath(path))
				.filter(path => !!path);
		},
		roleStrs() {
			return this.roles.map(({ name }) => name);
		},
		permStrs() {
			return this.permissions.map(({ name }) => name);
		}
	},
  mounted() {
    this.roles = JSON.parse(document.querySelector('meta[name="roles"]').content);
    this.permissions = JSON.parse(document.querySelector('meta[name="permissions"]').content);
  },
	methods: {
		handleCollapseOther: function(menu) {
			for (var i = 0; i < this.menus.length; i++) {
				this.$refs.sidebarNavList[i].collapse(menu);
			}
		},
		handleSidebarMinify: function() {
			this.pageOptions.pageSidebarMinified = !this.pageOptions.pageSidebarMinified;
		},
		reducePath(path) {
			if (path.roles) {
				if (!path.roles.some(role => this.roleStrs.some(r => r === role))) return null;
				if (path.children) {
					path.children = path.children
						.map(child => this.reducePath(child))
						.filter(child => !!child);

					if (!path.children.length) return null;
				}
				return path;
			}

			if (path.permissions) {
				if (!path.permissions.some(perm => this.permStrs.some(p => p === perm))) return null;
				if (path.children) {
					path.children = path.children
						.map(child => this.reducePath(child))
						.filter(child => !!child);

					if (!path.children.length) return null;
				}
				return path;
			}
		}
	}
}
</script>
