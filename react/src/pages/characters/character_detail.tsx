import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { charactersApi } from "../../api/characters_api";
import type { CharacterDto } from "../../dto/characters.dto";
import styles from "./character_detail.module.css";

interface ExtendedCharacterDto extends CharacterDto {
    user?: {
        name: string;
    }
}

export default function CharacterDetail() {
    const { id } = useParams<{ id: string }>();
    const [character, setCharacter] = useState<ExtendedCharacterDto | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        if (id) {
            charactersApi.getCharacter(id)
                .then(data => setCharacter(data as ExtendedCharacterDto))
                .catch(err => setError(err.message || "Ошибка при загрузке персонажа"))
                .finally(() => setLoading(false));
        }
    }, [id]);

    if (loading) return <div className={styles.loading}>Загрузка...</div>;
    if (error) return <div className={styles.error}>Ошибка: {error}</div>;
    if (!character) return <div className={styles.container}>Персонаж не найден</div>;

    return (
        <div className={styles.sheetContainer}>
            <div className={styles.sheet}>
                {/* Header */}
                <header className={styles.header}>
                    <div className={styles.nameSection}>
                        <div className={styles.nameValue}>{character.name}</div>
                        <div className={styles.label}>ИМЯ ПЕРСОНАЖА</div>
                    </div>

                    <div className={styles.infoBox}>
                        <div className={styles.infoRow}>
                            <div className={styles.field}>
                                <div className={styles.value}>{character.class || "—"}</div>
                                <div className={styles.label}>КЛАСС</div>
                            </div>
                            <div className={styles.field}>
                                <div className={styles.value}>{character.background || "—"}</div>
                                <div className={styles.label}>ПРЕДЫСТОРИЯ</div>
                            </div>
                        </div>
                        <div className={styles.infoRow}>
                            <div className={styles.field}>
                                <div className={styles.value}>{character.race || "—"}</div>
                                <div className={styles.label}>РАСА</div>
                            </div>
                            <div className={styles.field}>
                                <div className={styles.value}>Н-Д</div>
                                <div className={styles.label}>МИРОВОЗЗРЕНИЕ</div>
                            </div>
                            <div className={styles.field}>
                                <div className={styles.value}>0</div>
                                <div className={styles.label}>ОПЫТ</div>
                            </div>
                            <div className={styles.levelField}>
                                <div className={styles.value}>1</div>
                                <div className={styles.label}>УРОВЕНЬ</div>
                            </div>
                        </div>
                    </div>
                </header>

                {/* Content */}
                <main className={styles.mainContent}>
                    <div className={styles.personalitySection}>
                        <PersonalityBox title="ЧЕРТЫ ХАРАКТЕРА" content={character.traits} />
                        <PersonalityBox title="ИДЕАЛЫ" content={character.ideals} />
                        <PersonalityBox title="ПРИВЯЗАННОСТИ" content={character.attachments} />
                        <PersonalityBox title="СЛАБОСТИ" content={character.weaknesses} />
                    </div>
                    {/* Other sections can be added here (stats, equipment, etc.) */}
                </main>
            </div>
        </div>
    );
}

function PersonalityBox({ title, content }: { title: string; content?: string }) {
    return (
        <div className={styles.personalityBox}>
            <div className={styles.boxContent}>
                {content || ""}
            </div>
            <div className={styles.boxFooter}>
                <div className={styles.boxTitle}>{title}</div>
            </div>
        </div>
    );
}
