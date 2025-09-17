"use client";

import { useAuth } from "@/hooks/auth";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset, SidebarProvider } from "@/components/ui/sidebar";
import Loading from "./Loading";

const AppLayout = ({ children }) => {
  const { user } = useAuth({ middleware: "auth" });
  return !user ? (
    <Loading />
  ) : (
    <SidebarProvider>
      <AppSidebar user={user} />
      <SidebarInset>
        {children}
      </SidebarInset>
    </SidebarProvider>
  );
};

export default AppLayout;