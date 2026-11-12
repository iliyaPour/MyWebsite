import { createRouter, createWebHistory } from 'vue-router';
import ResumeApp from './components/ResumeApp.vue';
import ProjectLanding from './Projects/ProjectLanding.vue';
import AdminDashboard from './components/AdminDashboard.vue';

const routes = [
  {
    path: '/',
    name: 'resume',
    component: ResumeApp,
  },
  {
    path: '/admin',
    name: 'admin-dashboard',
    component: AdminDashboard,
  },
  {
    path: '/projects/:slug',
    name: 'project-landing',
    component: ProjectLanding,
    props: true,
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/',
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior() {
    return { top: 0 };
  },
});

export default router;
