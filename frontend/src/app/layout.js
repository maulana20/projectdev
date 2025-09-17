import { Nunito } from "next/font/google";
import { ClerkProvider } from "@clerk/nextjs";
import "@/app/global.css";

const clerkAppearanceObject = {
  cssLayerName: "clerk",
  variables: { colorPrimary: "#000000" },
  elements: {
    socialButtonsBlockButton:
      "bg-white border-gray-200 hover:bg-transparent hover:border-black text-gray-600 hover:text-black",
    socialButtonsBlockButtonText: "font-semibold",
    formButtonReset:
      "bg-white border border-solid border-gray-200 hover:bg-transparent hover:border-black text-gray-500 hover:text-black",
    membersPageInviteButton:
      "bg-black border border-black border-solid hover:bg-white hover:text-black",
    card: "bg-[#fafafa]",
  },
};

const nunitoFont = Nunito({
  subsets: ["latin"],
  display: "swap",
});

export const metadata = { title: 'Laravel' };

const RootLayout = ({ children }) => (
  <html lang="en" className={nunitoFont.className}>
    <ClerkProvider appearance={clerkAppearanceObject}>
      <body className="antialiased">{children}</body>
    </ClerkProvider>
  </html>
);

export default RootLayout;