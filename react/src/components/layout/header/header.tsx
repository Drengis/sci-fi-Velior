import { useState } from "react";
import { NavLink } from "react-router-dom";
import { Button } from "@/components/ui/button";
import styles from "./header.module.css";
import ThemeToggle from "@/components/themeToggle/themeToggle";
import { useAuthStore } from "../../../store/authStore";
import Modal from "../../ui/modal";
import Login from "../../../pages/login/login";
import Registration from "../../../pages/registration/registration";

export default function Header() {
    const { isAuthenticated, user, logout } = useAuthStore();
    const [isLoginOpen, setIsLoginOpen] = useState(false);
    const [isRegisterOpen, setIsRegisterOpen] = useState(false);

    const handleLogout = () => {
        logout();
    };

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

                {isAuthenticated ? (
                    <div className={styles.userSection}>
                        <span className={styles.userName}>
                            {user?.name}
                        </span>
                        <Button onClick={handleLogout} variant="outline">
                            Выход
                        </Button>
                    </div>
                ) : (
                    <div className={styles.authButtons}>
                        <Button onClick={() => setIsLoginOpen(true)}>
                            Вход
                        </Button>
                        <Button onClick={() => setIsRegisterOpen(true)} variant="outline">
                            Регистрация
                        </Button>
                    </div>
                )}
            </div>

            <Modal 
                isOpen={isLoginOpen} 
                onClose={() => setIsLoginOpen(false)} 
                title="Вход"
            >
                <Login onSuccess={() => setIsLoginOpen(false)} />
            </Modal>

            <Modal 
                isOpen={isRegisterOpen} 
                onClose={() => setIsRegisterOpen(false)} 
                title="Регистрация"
            >
                <Registration onSuccess={() => setIsRegisterOpen(false)} />
            </Modal>
        </header>
    );
}