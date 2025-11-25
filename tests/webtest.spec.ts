import { test, expect } from '@playwright/test';

test('login with valid credentials', async ({ page }) => {
  await page.goto('https://seatless-nonheritably-stephan.ngrok-free.dev/login');
    test.setTimeout(90000);

    await page.getByRole('button', { name: 'Visit Site' }).click();
    await page.getByLabel('Username').fill('Majid');
    await page.getByLabel('Password').fill('123456789');
    await page.getByRole('button', { name: 'Login' }).click();
    await page.waitForLoadState('networkidle');

  // Expect to be redirected to the dashboard
  await expect(page).toHaveURL('https://seatless-nonheritably-stephan.ngrok-free.dev/admin/dashboard');
  await expect(page.getByText('Dashboard')).toBeVisible();
});