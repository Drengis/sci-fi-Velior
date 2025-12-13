import { Button } from "@/components/ui/button";
import { useThemeStore } from "../../store/themeStore";

export default function ThemeToggle() {
  const { theme, toggleTheme } = useThemeStore();

  return (
    <Button onClick={toggleTheme}>
      {theme === "light" ? "🌞" : "🌙"}
    </Button>
  );
}