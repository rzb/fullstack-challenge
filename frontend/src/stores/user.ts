import { defineStore } from 'pinia'

// I'm leaving it here for easier setup and review for the purposes of the challenge,
// but ideally the base url should be moved to a .env file.
const usersUrl = 'http://localhost/users'

export const useUserStore = defineStore('user', {
  state: () => ({
    users: Object,
    user: null,
    loading: false,
    error: null,
  }),

  getters: {},

  actions: {
    async fill(page: number = 1) {
      this.loading = true
      try {
        this.users = await fetch(`${usersUrl}?page=${page}`)
          .then((response: Response) => response.json())
      } catch (error: any) {
        this.error = error
      } finally {
        this.loading = false
      }
    },
    async find(id: number) {
      this.user = null
      this.loading = true
      try {
        this.user = await fetch(`${usersUrl}/${id}`)
          .then((response: Response) => response.json())
          .then((json) => json.data)
      } catch (error: any) {
        this.error = error
      } finally {
        this.loading = false
      }
    }
  }
})