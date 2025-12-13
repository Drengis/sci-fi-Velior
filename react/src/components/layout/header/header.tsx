import { NavLink } from "react-router-dom";
import { Button } from "@/components/ui/button";
import styles from "./header.module.css";
import ThemeToggle from "@/components/themeToggle/themeToggle";

export default function Header() {
    return (
        <header className={styles.header}>
            <div className={styles.left}>
                <Button asChild variant="ghost">
                    <NavLink to="/armor">Броня</NavLink>
                </Button>

                <Button asChild variant="ghost">
                    <NavLink to="/weapons">Оружие</NavLink>
                </Button>

                <Button asChild variant="ghost">
                    <NavLink to="/characters">Персонажи</NavLink>
                </Button>
            </div>

            <div className={styles.right}>
                <ThemeToggle />

                <Button asChild>
                    <NavLink to="/login">Вход</NavLink>
                </Button>

                <Button asChild>
                    <NavLink to="/register">Регистрация</NavLink>
                </Button>
            </div>
        </header>
    );
}