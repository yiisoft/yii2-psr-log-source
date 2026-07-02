const isDependabotBump = (message) => (
    message.startsWith('Bump ') &&
    message.includes('Signed-off-by: dependabot[bot] <support@github.com>')
);

export default {
    extends: ['@commitlint/config-conventional'],
    ignores: [isDependabotBump],
};
