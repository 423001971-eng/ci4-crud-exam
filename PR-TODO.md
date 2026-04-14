# Create PR for getGlobal() Fix

1. [ ] Install GitHub CLI: `winget install --id GitHub.cli` (restart terminal/VSCode after).
2. [ ] Verify: `gh auth status` & `gh --version`.
3. [ ] Git clean: `git checkout -- app/Filters/ApiAuthFilter.php`.
4. [ ] Stage: `git add app/Controllers/Api/BaseApiController.php TODO.md`.
5. [ ] Commit: `git commit -m "fix(api): resolve getGlobal() error in BaseApiController\n\nReplace non-existent getGlobal('apiUser') with getVar('apiUser') to correctly read ApiAuthFilter-set globals. Fixes PHP0418 lint error."`.
6. [ ] Push: `git push origin api-integration-work`.
7. [ ] Create PR: `gh pr create --title "fix(api): resolve BaseApiController getGlobal() error" --body "Fixes PHP0418: Call to unknown method getGlobal(). Uses CI4 getVar() for apiUser from filter. Verified routes/API flow. Closes #X if applicable." --base main`.
8. [ ] Complete.

**Status**: Ready to execute step-by-step.
