# Gitment4typecho 帮助文档 - Taskeren
## Github OAuth Application 注册
1. 进入[APP新建页面](https://github.com/settings/applications/new)。
2. 随便填入一个名字到 Application name，这会显示在登陆时登陆的机构名称。
3. 在 Homepage URL 中填入网站的URL。
4. 随便在 Application description 中写一点注解。可有可无。
5. 在 Authorization callback URL 中填入网站的URL。
6. 注册，点击 Register Application。
7. 注册后将跳出 Application 控制界面，记住 `Client ID` 和 `Client Secret`。

## Typecho控制台 配置
1. 将 插件 导入到Typecho。
2. 启用插件
3. 点击设置，进入设置页面。
4. 在 `id` 中填入一个不同页面会改变的值。推荐为 “location.href”。
5. 在 `owner` 中填入注册 Application 的 Github ID。
6. 在 `repo` 中填入用于存储评论的项目名称。如果没有可以新建一个，不需要任何东西，只要保证能用 Issue。
7. 在 `client id` 和 `client secret` 中填入 *Github OAuth Application 注册* 中的 `Client ID` 和 `Client Secret`。
8. 如果您使用的是自定义的主题，请确认您的评论所在的 DIV 的 id 为 `comments`，否则您需要在 `原评论元素` 中填入当前主题的评论 DIV（使用jQuery选择器）和在 `新评论DIV元素` 中填入当前主题的评论 DIV 的 id（只可是DIV的id）。
